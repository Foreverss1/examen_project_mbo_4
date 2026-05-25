<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Exstra_opties;
use App\Models\Baan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Queue\Middleware\Skip;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationCreated;
use App\Mail\ReservationEdited;
use App\Mail\ReservationDeleted;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->role_id == 1) {
            $data = Reservation::all();
        } else {
            $data = Reservation::where('users_id', auth()->user()->id)->get();
        }

        $data_boeking = Booking::all();
        foreach ($data as $item) {
            //add banen aan de array data
            $item->banen = $item->boeking_count = Booking::where('reservations_id', $item->id)->count();
        }

        foreach ($data as $item) {
            $startDate = new DateTime($item->time_start);
            $endDate = new DateTime($item->time_end);
            //get diffrese between star and end time
            $interval = $startDate->diff($endDate);
            $hours = $interval->days * 24 + $interval->i;

            $minutes = $interval->i;
            $item->duration = $hours;

        }

        $image = "  src=" . url(asset('storage/img/add-symbol.svg'));

        return view('reservations.index', compact('data', 'image'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = Exstra_opties::all();
        $today = now()->format('Y-m-d\TH:i');

        return view('reservations.create', compact('data', 'today'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'num_adults' => 'required|integer|min:1|max:64',
            'num_kids' => 'nullable|integer|min:0|max:50',
            'exstra_opties_id' => 'required|exists:exstra_opties,id',
            'time_start' => 'required|date_format:Y-m-d\TH:i',
            'time' => 'required|integer|min:1|max:8',
            'banen' => 'required|integer|min:1|max:8',
        ]);

        // check if number of people is possible
        $capacityError = $this->validateCapacity(
            $data['num_adults'],
            $data['num_kids'] ?? 0,
            $data['banen']
        );

        if ($capacityError !== true) {
            return back()->withErrors([
                'num_adults' => $capacityError
            ])
                ->withInput();
        }


        //start time (rounded to hour)
        $start = Carbon::createFromFormat('Y-m-d\TH:i', $data['time_start'])
            ->startOfHour();
        //make end time bij adding duration(hours) start_time
        $duration = intval($data['time']);
        $end = $start->copy()->addHours($duration);

        // check banen with one is available
        $availableBanen = [];
        for ($baan = 1; $baan <= 8; $baan++) {
            if ($this->isBaanAvailable($baan, $start, $end)) {
                $availableBanen[] = $baan;
            }
        }

        if (count($availableBanen) < $data['banen']) {
            return back()->withErrors([
                'banen' => 'Niet genoeg vrije banen beschikbaar.'
            ]);
        }
        $selectedBanen = array_slice($availableBanen, 0, $data['banen']);

        //create reservation
        $reservation = Reservation::create([
            'num_adults' => $data['num_adults'],
            'num_kids' => $data['num_kids'],
            'exstra_opties_id' => $data['exstra_opties_id'],
            'time_start' => $start,
            'time_end' => $end,
            'users_id' => auth()->id(),
        ]);

        //make boekingens for the banen
        foreach ($selectedBanen as $baanId) {
            Booking::create([
                'baan_id' => $baanId,
                'reservations_id' => $reservation->id,
            ]);
        }
        // get exstaoptie naam for mail
        $option = Exstra_opties::findOrFail($data['exstra_opties_id']);

        Mail::to(auth()->user()->email)
            ->send(new ReservationCreated($reservation, $data['time'], $option->naam));

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservering succesvol aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $data = Exstra_opties::all();
        $data_boeking = Booking::all();

        $today = now()->format('Y-m-d\TH:i');

        $startDate = new DateTime($reservation->time_start);
        $endDate = new DateTime($reservation->time_end);
        //get diffrese between star and end time
        $interval = $startDate->diff($endDate);
        // $hours = $interval->days * 24 + $interval->h;

        $reservation->hours = $interval->days * 24 + $interval->h;
        $reservation->banen = Booking::where('reservations_id', $reservation->id)->count();

        return view('reservations.edit', compact('data', 'reservation', 'today', ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'num_adults' => 'required|integer|min:1|max:64',
            'num_kids' => 'nullable|integer|min:0|max:50',
            'banen' => 'required|integer|min:1|max:8',
            'exstra_opties_id' => 'required|exists:exstra_opties,id',
            'time_start' => 'required|date',
            'time' => 'required|integer|min:1|max:12',
        ]);

        // check if number of people is possible
        $capacityError = $this->validateCapacity(
            $data['num_adults'],
            $data['num_kids'] ?? 0,
            $data['banen']
        );

        if ($capacityError !== true) {
            return back()
                ->withErrors([
                    'num_adults' => $capacityError,
                ])
                ->withInput();
        }

        // start time (rounded to hour)
        $start = Carbon::createFromFormat('Y-m-d\TH:i', $data['time_start'])
            ->startOfHour();
        //make end time bij adding duration(hours) start_time
        $duration = intval($data['time']);
        $end = $start->copy()->addHours($duration);

        // check which banen are available
        $availableBanen = [];
        for ($baan = 1; $baan <= 8; $baan++) {

            if ($this->isBaanAvailable($baan, $start, $end,)) {
                $availableBanen[] = $baan;
            }elseif($baan = $id){
                $availableBanen[] = $baan;
            }
        }

        if (count($availableBanen) < $data['banen']) {
            return back()->withErrors([
                'banen' => 'Niet genoeg vrije banen beschikbaar.',
            ])->withInput();
        }

        $selectedBanen = array_slice($availableBanen, 0, $data['banen']);
        // update reservation
        $reservation = Reservation::findOrFail($id);

        $data['time_start'] = $start; // or $start->format('Y-m-d H:i:s') if needed in DB
        $reservation->update($data);

        // delete old bookings for this reservation
        Booking::where('reservations_id', $reservation->id)->delete();

        // create new bookings
        foreach ($selectedBanen as $baanId) {
            Booking::create([
                'baan_id' => $baanId,
                'reservations_id' => $reservation->id,
            ]);
        }

        // get extra option name for mail
        $option = Exstra_opties::findOrFail($data['exstra_opties_id']);

        // send mail
        Mail::to(auth()->user()->email)
            ->send(new ReservationCreated($reservation, $data['time'], $option->naam));

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservering updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = Reservation::findOrFail($id);
        // get exstaoptie naam for mail
        $options_id = $data->exstra_opties_id;
        $options = Exstra_opties::findOrFail(id: $options_id);
        $option_name = $options->naam;

        //send mail
        Mail::to('addystout04@gmail.com')->send(new ReservationDeleted($data, $option_name));


        $data->delete();
        return redirect()->route('reservations.index')->with('success', 'reseveering deleted successfully');
    }

    /**
     * Check availability of banen
     */
    public function isBaanAvailable($baanId, Carbon $start, Carbon $end): bool
    {
        return !Booking::where('baan_id', $baanId)
            ->whereHas('reservation', function ($q) use ($start, $end) {

                $q->where('time_start', '<', $end)
                    ->where('time_end', '>', $start);

            })
            ->exists();
    }
    public function validateCapacity($adults, $kids, $banen)
    {
        // make globol varable
        $maxAdultsPerBaan = 8;
        $minimumAdultsPerBaan = 6;
        $maxKidsPerBaan = 4;

        $maxAdultsTotal = $banen * $maxAdultsPerBaan;
        $minimumAdultTotal = $banen * $minimumAdultsPerBaan;
        $maxKidsTotal = $banen * $maxKidsPerBaan;

        if ($adults > $maxAdultsTotal ) {
            return "Te veel volwassenen voor {$banen} banen (max {$maxAdultsTotal}).";
        }

        if ($kids > $maxKidsTotal and $adults < $minimumAdultTotal) {
            return "Te veel kinderen voor {$banen} banen (max {$maxKidsTotal}, min volwassenen {$minimumAdultsPerBaan} ).";
        }

        return true;
    }

}

