<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Dokumentasi API PraktikumApi",
 *      description="REVI WAHYU ABDILLAH | G211220039",
 *      @OA\Contact(
 *          email="email@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

class MahasiswaController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/mahasiswas",
     * summary="Dapatkan daftar semua mahasiswa",
     * description="Mengembalikan daftar semua mahasiswa",
     * operationId="getMahasiswa",
     * tags={"Mahasiswa"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Daftar mahasiswa",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(ref="#/components/schemas/Mahasiswa")
     * )
     * )
     */
    public function index()
    {
        return response()->json(Mahasiswa::all(), 200);
    }

    /**
     * @OA\Post(
     * path="/api/mahasiswas",
     * summary="Tambah mahasiswa baru",
     * description="Menyimpan data mahasiswa baru",
     * operationId="storeMahasiswa",
     * tags={"Mahasiswa"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(ref="#/components/schemas/Mahasiswa")
     * ),
     * @OA\Response(
     * response=201,
     * description="Mahasiswa berhasil ditambahkan",
     * @OA\JsonContent(ref="#/components/schemas/Mahasiswa")
     * )
     * )
     */
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());
        return response()->json($mahasiswa, 201);
    }

    /**
     * @OA\Get(
     * path="/api/mahasiswas/{id}",
     * summary="Dapatkan data mahasiswa",
     * description="Mengembalikan data mahasiswa berdasarkan ID",
     * operationId="getMahasiswaById",
     * tags={"Mahasiswa"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *    name="id",
     *    in="path",
     *    required=true,
     *    @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Data mahasiswa",
     * @OA\JsonContent(ref="#/components/schemas/Mahasiswa")
     * )
     * )
     */
    public function show(string $id)
    {
        return response()->json(Mahasiswa::findOrFail($id), 200);
    }

    /**
     * @OA\Put(
     * path="/api/mahasiswas/{id}",
     * summary="Perbarui data mahasiswa",
     * description="Memperbarui data mahasiswa berdasarkan ID",
     * operationId="updateMahasiswa",
     * tags={"Mahasiswa"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *    name="id",
     *    in="path",
     *    required=true,
     *    @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(ref="#/components/schemas/Mahasiswa")
     * ),
     * @OA\Response(
     * response=200,
     * description="Data mahasiswa berhasil diperbarui",
     * @OA\JsonContent(ref="#/components/schemas/Mahasiswa")
     * )
     * )
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return response()->json($mahasiswa, 200);
    }

    /**
     * @OA\Delete(
     * path="/api/mahasiswas/{id}",
     * summary="Hapus data mahasiswa",
     * description="Menghapus data mahasiswa berdasarkan ID",
     * operationId="deleteMahasiswa",
     * tags={"Mahasiswa"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *    name="id",
     *    in="path",
     *    required=true,
     *    @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=204,
     * description="Mahasiswa berhasil dihapus"
     * )
     * )
     */
    public function destroy(string $id)
    {
        Mahasiswa::destroy($id);
        return response()->json(null, 204);
    }
}
