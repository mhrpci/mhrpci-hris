<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $policy->title ?? '') }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $policy->content ?? '') }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="sort_order">Sort Order</label>
    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $policy->sort_order ?? '') }}" required>
    @error('sort_order')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="section_id">Section</label>
    <select class="form-control @error('section_id') is-invalid @enderror" id="section_id" name="section_id" required>
        <option value="">Select a section</option>
        @foreach($sections as $section)
            <option value="{{ $section->id }}" {{ (old('section_id', $policy->section_id ?? '') == $section->id) ? 'selected' : '' }}>
                {{ $section->name }}
            </option>
        @endforeach
    </select>
    @error('section_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
