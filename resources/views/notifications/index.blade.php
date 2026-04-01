@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
            <p class="text-gray-600">Daftar semua notifikasi</p>
        </div>
        @if($notifications->where('read_at', null)->count() > 0)
        <form action="{{ route('notifications.markAll') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm">
                <i class="fas fa-check-double mr-2"></i>Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    @if($notifications->isEmpty())
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <i class="fas fa-bell-slash text-6xl text-gray-300 mb-4"></i>
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Notifikasi</h2>
        <p class="text-gray-500">Notifikasi akan muncul saat ada peminjaman baru atau buku yang terlambat dikembalikan.</p>
    </div>
    @else
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="divide-y">
            @foreach($notifications as $notification)
            <div class="p-4 hover:bg-gray-50 transition {{ $notification->read_at ? 'opacity-70' : 'bg-indigo-50' }}" id="notification-{{ $notification->id }}">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        @if($notification->type === 'borrowing_new')
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-book-reader text-green-600"></i>
                            </div>
                        @elseif($notification->type === 'overdue')
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                        @else
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bell text-blue-600"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-800 {{ $notification->read_at ? '' : 'font-bold' }}">
                                {{ $notification->title }}
                            </h3>
                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">{!! $notification->message !!}</p>
                        @if(!$notification->read_at)
                        <button onclick="markAsRead({{ $notification->id }})" class="mt-2 text-sm text-indigo-600 hover:text-indigo-800">
                            <i class="fas fa-check mr-1"></i>Tandai sebagai dibaca
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="p-4 border-t bg-gray-50">
            {{ $notifications->links() }}
        </div>
    </div>
    @endif
</div>

<script>
function markAsRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection
