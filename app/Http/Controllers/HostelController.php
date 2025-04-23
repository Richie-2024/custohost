<?php

namespace App\Http\Controllers;

use App\Http\Requests\HostelRequest;
use App\Services\HostelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HostelController extends Controller
{
    protected $hostelService;

    public function __construct(HostelService $hostelService)
    {
        $this->hostelService = $hostelService;
    }

    public function index()
    {
        $hostels = $this->hostelService->getHostelsByOwner(Auth::id());
        // dd('okay');
        return view('hostels.index', compact('hostels'));
    }

    public function create()
    {
        return view(view: 'hostels.create');
    }

    public function store(HostelRequest $request)
    {
        $hostel = $this->hostelService->createHostel($request->validated());
        return redirect()->route('hostels.show', $hostel)
            ->with('success', 'Hostel created successfully.');
    }

    public function show($id)
    {
        $hostel = $this->hostelService->findById($id);
        return view('hostels.show', compact('hostel'));
    }

    public function edit($id)
    {
        $hostel = $this->hostelService->findById($id);
        return view('hostels.edit', compact('hostel'));
    }

    public function update(HostelRequest $request, $id)
    {
        $hostel = $this->hostelService->findById($id);
        $this->hostelService->updateHostel($hostel, $request->validated());
        return redirect()->route('hostels.show', $hostel)
            ->with('success', 'Hostel updated successfully.');
    }

    public function destroy($id)
    {
        $this->hostelService->deleteHostel($id);
        return redirect()->route('hostels.index')
            ->with('success', 'Hostel deleted successfully.');
    }

    public function browse(Request $request)
    { 
        $hostels = $this->hostelService->getAllHostels();
        return view('hostels.browse', compact('hostels'));
    }

    public function details($id)
    {
        $hostel = $this->hostelService->findById($id);
        return view('hostels.details', compact('hostel'));
    }

    public function rooms($id)
    {
        $hostel = $this->hostelService->findById($id);
        return route('rooms.index', $hostel->id);
    }

    public function bookings($id)
    {
        $hostel = $this->hostelService->findById($id);
        return view('hostels.bookings', compact('hostel'));
    }

    public function payments($id)
    {
        $hostel = $this->hostelService->findById($id);
        return view('hostels.payments', compact('hostel'));
    }
}