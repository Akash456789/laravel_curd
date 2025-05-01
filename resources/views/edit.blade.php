<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mt-3">
            <div>
              <h1 class="">Edit User Form</h1>
            </div>
           <div>
            <a href="{{route('index')}}" type="button" style="bottom:0px;" class="btn btn-primary">Show User Data</a>
    
           </div>
          </div>
        <div class="row">
            <div class="col-md-12 my-3">
             
                <form action="{{ route('update', $curd->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $curd->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $curd->email }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" name="city" required>
                            <option value="">Select City</option>
                            <option value="Noida" {{ $curd->city == 'Noida' ? 'selected' : '' }}>Noida</option>
                            <option value="Delhi" {{ $curd->city == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                            <option value="Jaipur"
                             {{ $curd->city == 'Jaipur' ? 'selected' : '' }}>Jaipur</option>
                        </select>
                        
                    </div>
                    
                    <div class="mb-3">
                        <label for="language">Language</label>
                        <div class="d-flex pt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="language[]" id="language_hindi" value="Hindi" {{ in_array('Hindi', explode(',', $curd->language)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="language_hindi">Hindi</label>
                            </div>
                            <div class="form-check mx-5">
                                <input class="form-check-input" type="checkbox" name="language[]" id="language_english" value="English" {{ in_array('English', explode(',', $curd->language)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="language_english">English</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Male" {{ $curd->gender == 'Male' ? 'checked' : '' }} required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female" {{ $curd->gender == 'Female' ? 'checked' : '' }} required>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>


                    
                    <div class="form-group mb-3">
                        <label for="photo">Photo:</label>
                        @if ($curd->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $curd->photo) }}" alt="Current Photo" style="max-width: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        <small class="form-text text-muted">Upload a new image to replace the current one (optional).</small>
                        @error('photo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message">{{ $curd->message }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>