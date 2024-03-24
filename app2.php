<div class="col-md-6 col-12">
    <label for="traveller_id" class="form-label">Select Traveller <span class="text-danger">*</span></label>
    <select name="traveller_id" id="traveller_id" class="form-select" aria-label="form-select-sm example" required>
        <option value="">Select a traveller</option>
        @foreach ($allTravellers as $traveller)
        <option value="{{  $traveller->id }}" {{ old('traveller_id') == $traveller->id ? 'selected' : '' }}>{{ $traveller->name }}</option>
        @endforeach
    </select>
    @error('traveller_id')
    <span class="small text-danger">{{ $message }}</span>
    @enderror
</div>