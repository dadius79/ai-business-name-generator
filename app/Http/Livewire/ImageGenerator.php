<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use Livewire\Component;
use Tectalic\OpenAi\Client;
use Tectalic\OpenAi\ClientException;
use Tectalic\OpenAi\Models\Completions\CreateRequest;
use Tectalic\OpenAi\Models\Completions\CreateResponse;
use Tectalic\OpenAi\Models\Completions\CreateResponseChoicesItem;

class ImageGenerator extends Component
{
    
    public string $instruction = '';
    
    public array $images = [];

    protected $rules = [
        'instruction' => 'required',
    ];
    
    public function render()
    {
        return view('livewire.image-generator');
    }

    public function generateImages(Client $client): void
    {
        $validated = $this->validate();

        $this->clearValidation();

        $prompt = $validated['instruction'];


        $request = $client->imagesGenerations()->create(
            new CreateRequest([
                'model' => '',
                'prompt' => 'A Lion',
                'size' => '256x256',
                'n' => 5
            ])
        );


        try{
            $result = $request->toModel();

            $this->images = Arr::map($result->data, function(CreateResponseChoicesItem $item){
                return $item->url;
            });

        } catch(ClientException $e){

            //Add Reset Input Function
            $this->addError('results', _('Results are temporarily unavailable. Please try again later.'));
        }
    }
}
