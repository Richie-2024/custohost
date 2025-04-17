<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index()
    {
        $rooms = $this->roomService->getPaginatedRooms(auth()->user()->hostel_id);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(RoomRequest $request)
    {
        $room = $this->roomService->createRoom($request->validated());
        return redirect()->route('rooms.show', $room)
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

    public function update(RoomRequest $request, $id)
    {
        $room = $this->roomService->findById($id);
        $this->roomService->updateRoom($room, $request->validated());
        return redirect()->route('rooms.show', $room)
            ->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $this->roomService->deleteRoom($id);
        return redirect()->route('rooms.index')
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