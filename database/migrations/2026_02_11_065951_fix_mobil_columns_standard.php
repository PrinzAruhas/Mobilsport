<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            // 1. Ganti nama kolom jika 'stok' sudah ada, atau buat baru jika belum
            if (Schema::hasColumn('mobils', 'stok')) {
                $table->renameColumn('stok', 'stock');
            } else {
                $table->integer('stock')->default(1)->after('harga_sewa');
            }

            // 2. Memastikan kolom status sesuai dengan kebutuhan aplikasi
            // Gunakan string jika enum sering berubah (lebih fleksibel)
            $table->string('status')->default('tersedia')->change();
            
            // 3. Pastikan kolom pendukung lainnya ada (opsional tapi disarankan)
            if (!Schema::hasColumn('mobils', 'video')) {
                $table->string('video')->nullable()->after('gambar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            if (Schema::hasColumn('mobils', 'stock')) {
                $table->renameColumn('stock', 'stok');
            }
        });
    }
};