<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Hostel;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index($hostelId)
    {
        $rooms = $this->roomService->getPaginatedRooms($hostelId);
        $hostel= Hostel::findOrFail($hostelId);
        return view('rooms.index', compact('rooms', 'hostel'));
    }

    public function create(Hostel $hostel)
    {
        return view('rooms.create',compact('hostel'));
    }

    public function store(RoomRequest $request)
    {
        $room = $this->roomService->createRoom($request->validated());
        return redirect()->route('rooms.index', $room->hostel)
            ->with('success', 'Room created successfully.');
    }

    public function show($id)
    {
        $room = $this->roomService->findById($id);
        return view('rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = $this->roomService->findById($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(RoomRequest $request, $room)
    {
        $room = $this->roomService->findById($room);
        $this->roomService->updateRoom($room, $request->validated());
        return redirect()->route('rooms.show', $room)
            ->with('success', 'Room updated successfully.');
    }

    public function destroy(Request $request, $room)
    {
       
        $this->roomService->deleteRoom($room);
        return redirect()->route('rooms.index',$request->hostel_id)
            ->with('success', 'Room deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $room = $this->roomService->findById($id);
        $this->roomService->updateStatus($room, $request->status);
        return back()->with('success', 'Room status updated successfully.');
    }

    public function checkAvailability(Request $request, $id)
    {
        $room = $this->roomService->findById($id);
        $isAvailable = $this->roomService->checkAvailability(
            $room->id,
            $request->check_in_date,
            $request->check_out_date
        );

        return response()->json(['available' => $isAvailable]);
    }
}