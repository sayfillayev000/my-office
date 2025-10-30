<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_obyect', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('coordinates')->nullable(); // raw coordinates string/geojson
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('bolim_id')->nullable();
            // Postgres specific point columns (center, obyect_center)
            // will be added via raw statements below
            $table->timestamps();

            // B-Tree indexes
            $table->index('bolim_id', 'Menyu_obyect_bolim_id_index');
            $table->index('organization_id', 'Menyu_obyect_organization_id_index');

            // FKs
            $table->foreign('bolim_id')
                ->references('id')->on('Menyu_obyektbolim')
                ->nullOnDelete();
            $table->foreign('organization_id')
                ->references('id')->on('Menyu_organization')
                ->nullOnDelete();
        });

        // Add Postgres point columns and GiST indexes if possible
        try {
            DB::statement('ALTER TABLE "Menyu_obyect" ADD COLUMN center point NULL');
            DB::statement('ALTER TABLE "Menyu_obyect" ADD COLUMN obyect_center point NULL');
            // GiST indexes
            DB::statement('CREATE INDEX "CenterIND" ON "Menyu_obyect" USING GIST (center)');
            DB::statement('CREATE INDEX "menyu_obyect_obyect_center_gist" ON "Menyu_obyect" USING GIST (obyect_center)');
        } catch (Throwable $e) {
            // Skip silently if DB doesn't support point/GiST
        }
    }

    public function down(): void
    {
        // Drop GiST indexes and point columns if they exist
        try {
            DB::statement('DROP INDEX IF EXISTS "CenterIND"');
            DB::statement('DROP INDEX IF EXISTS "menyu_obyect_obyect_center_gist"');
            DB::statement('ALTER TABLE "Menyu_obyect" DROP COLUMN IF EXISTS center');
            DB::statement('ALTER TABLE "Menyu_obyect" DROP COLUMN IF EXISTS obyect_center');
        } catch (Throwable $e) {
            // ignore
        }

        Schema::dropIfExists('Menyu_obyect');
    }
};


