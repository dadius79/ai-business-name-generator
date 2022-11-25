<form wire:submit.prevent="generateImages" class="mt-4 py-4 sm:border-t sm:border-gray-200 sm:pt-5">
    @csrf
    <p>
        <label for="industry" class="font-semibold block py-2">{{ __('Enter your instructions') }}</label>
        @error('industry') <span class="text-red-400 font-semibold">{{ $message }}</span> @enderror
        <input type="text" name="instruction" wire:model="instruction" class="form-control" id="exampleFormControlInput1">
    </p>

    @error('results') <span class="text-red-400 font-semibold">{{ $message }}</span> @enderror

    <p class="py-2">
        <button wire:click="generateImages" wire:loading.attr="disabled" class="inline-flex justify-center rounded-lg text-md font-semibold py-3 px-4 bg-slate-900 text-white hover:bg-slate-700 disabled:opacity-30 disabled:cursor-not-allowed">{{ __('Generate Your Names') }}</button>
        <button wire:click="clear" type="button"  class="inline-flex justify-center rounded-lg text-md font-semibold py-3 px-4 bg-white/0 text-slate-900 ring-1 ring-slate-900/10 hover:bg-white/25 hover:ring-slate-900/15 ">{{ __('Reset') }}</button>
    </p>

    <div wire:loading.delay wire:loading.block wire:target="generateNames" class="mt-4">
            {{ __('Please wait, generating your images ...') }}
    </div>

    <div wire:loading.remove class="mt-4">
        @if (!empty($images))
            <h2 class="text-lg font-bold">{{ ('Your Results') }}</h2>
            <ul class="mt-4 ml-6 list-disc">
                @foreach( $images as $image)
                    <li class="p-1">{{ $image }}</li>
                @endforeach
            </ul>
        @endif
    </div>

</form>


