   @props(['name' => 'required'])

   @error ($name)
   <p class="text-xs mt-1 text-error">{{ $message }}</p>
   @enderror