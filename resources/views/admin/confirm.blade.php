@extends('layout.navbar')

@section('container')

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p>Tidak ada pesanan.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2">User</th>
                    <th class="text-left px-4 py-2">Total</th>
                    <th class="text-left px-4 py-2">Status</th>
                    <th class="text-left px-4 py-2">Tanggal</th>
                    <th class="text-left px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $order->user->name }}</td>
                    <td class="px-4 py-2">Rp{{ number_format($order->total) }}</td>
                    <td class="px-4 py-2">
                        @if($order->status === 'confirmed')
                            <span class="text-green-600 font-semibold">Terkonfirmasi</span>
                        @else
                            <span class="text-yellow-600">Pending</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-2">
                        @if($order->status === 'pending')
                        <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Konfirmasi
                            </button>
                        </form>
                        @else
                            <span class="text-gray-500 italic">Sudah dikonfirmasi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection