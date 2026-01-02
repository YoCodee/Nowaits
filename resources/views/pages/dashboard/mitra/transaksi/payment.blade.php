<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-4">Upload Bukti Pembayaran</h1>

            <div class="flex gap-8 flex-col md:flex-row">
                <!-- Instruction -->
                <div class="flex-1 space-y-4">
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 text-sm text-blue-800">
                        <p class="font-bold mb-2">Instruksi Pembayaran</p>
                        <ul class="list-disc ml-4 space-y-1">
                            <li>Silakan transfer ke rekening Petani sesuai nominal.</li>
                            <li>Total Tagihan: <strong>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</strong></li>
                            <li>Pastikan nama pengirim sesuai dengan akun Anda.</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase mb-2">Rekening Tujuan (Petani)</p>
                        <p class="font-bold text-lg text-gray-900">BCA 1234567890</p>
                        <p class="text-sm text-gray-600">a.n {{ $transaksi->penjual->name }}</p>
                    </div>
                </div>

                <!-- Form -->
                <div class="flex-1">
                    <form action="{{ route('transaksi.payment.update', $transaksi->id_transaksi) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Bukti Transfer (Foto/Screenshot)</label>
                            <input type="file" name="bukti_bayar" class="w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-[#bef264] file:text-[#022c22]
                                hover:file:bg-[#a3e635]
                            " required>
                        </div>

                        <button type="submit" class="w-full bg-[#022c22] text-[#bef264] py-3 rounded-xl font-bold hover:bg-[#033a2d] transition-colors shadow-lg">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
