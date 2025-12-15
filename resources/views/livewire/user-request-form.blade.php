<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Buat Request Baru (Data Nasabah)</h3>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Layanan</label>
            <select wire:model.live="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                <option value="new_account">Buka Rekening Nasabah Baru</option>
                <option value="block_account">Blokir Rekening Nasabah</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Nasabah (Sesuai KTP)</label>
            <input wire:model="nama_lengkap" type="text" placeholder="Contoh: Budi Santoso" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-teal-500 focus:border-teal-500">
            @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">NIK KTP Nasabah (16 Digit)</label>
            <input wire:model="nik" type="text" maxlength="16" placeholder="32xxxxxxxxxxxxxx" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-teal-500 focus:border-teal-500">
            @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        @if($type == 'new_account')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">No. Handphone Nasabah</label>
            <input wire:model="no_hp" type="text" maxlength="15" placeholder="08xxxxxxxxxx" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-teal-500 focus:border-teal-500">
            @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        @endif

        @if($type == 'block_account')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">No. Rekening Nasabah (Yang akan diblokir)</label>
            <input wire:model="no_rekening" type="text" maxlength="20" placeholder="xxxxxxxxxx" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-teal-500 focus:border-teal-500">
            @error('no_rekening') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        @endif
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alasan / Catatan Tambahan (Opsional)</label>
            <textarea wire:model="reason" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-teal-500 focus:border-teal-500"></textarea>
            @error('reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-[#00A39D] hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Kirim Request
            </button>
        </div>
    </form>
</div>
