<?php
namespace App\Services;
use App\Models\Pokemon;
use App\Services\FileUploadService;

class PokemonService{

    /**
     * FileUploadService instance.
     *
     * @return void
     */
    public function __construct(FileUploadService $file_upload_service)
    {
        $this->file_upload_service = $file_upload_service;
    }

    /**
     * Get Pokemons.
     *
     * @param string $form
     * @param int $latitude
     * @param int $longitude
     * @return Pokemon
     */
    public function get($form = null,$latitude = null ,$longitude = null){

        $pokemons = Pokemon::query();

        if($form){
         $pokemons = $pokemons->where('form',$form);
        }

        if($latitude){
        $pokemons = $pokemons->where('latitude',$latitude);
        }
        
        if($latitude){
        $pokemons = $pokemons->where('longitude',$longitude);
        }
        return $pokemons->get();
    }

    /**
     * Store Pokemon.
     *
     * @param string $name
     * @param string $image
     * @param int $serial_number
     * @param string $form
     * @param int $latitude
     * @param int $longitude
     * @return Pokemon
     */
    public function store($name,$image,$serial_number,$form,$latitude,$longitude) {
        $image_path = $this->file_upload_service->upload($image,'pokemon');

        $pokemon =  Pokemon::create([
            'name'=>$name,
            'serial_number'=>$serial_number,
            'form'=>$form,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
            'image_path' => $image_path
        ]);

        return $pokemon;
    }
    
    /**
     * Update Pokemon.
     *
     * @param int $id
     * @param string $image
     * @param string $form
     * @param int $latitude
     * @param int $longitude
     * @return Pokemon
     */
    public function update($id,$image,$form,$latitude,$longitude) {
        
        $pokemon = Pokemon::find($id);
        $pokemon->form = $form;
        $pokemon->latitude = $latitude;
        $pokemon->longitude = $longitude;

        if($pokemon->image_path){
            $this->file_upload_service->delete($pokemon->image_path);
        }

        $image_path = $this->file_upload_service->upload($image,'pokemon');
        $pokemon->image_path = $image_path;

        $pokemon->save();


        return $pokemon;
    }

    /**
     * Destroy Pokemon.
     * @param int $id
     */
    public function destroy(int $id){
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->delete();
    }

    /**
     * Get Pokemon by id.
     *
     * @return Pokemon
     */
    public function getById(int $id){
        return Pokemon::findOrFail($id);
    }


}