<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

      <div class="d-flex justify-content-between mt-3">
        <div>
          <h1 class="">User Form</h1>
        </div>
       <div>
        <a href="{{route('index')}}" type="button" style="bottom:0px;" class="btn btn-primary">Show User Data</a>
       </div>
      </div>


        <div class="row">
            <div class="col-md-12 m3-5">
                <!-- message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- <form  action="{{ route('store') }}" enctype="multipart/form-data" method="POST"> --}}
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">


                  @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="city">City Name:</label>
                        <select class="form-select" id="city" name="city">
                            <option value="">Select City</option>
                            <option value="Noida" {{ old('city') == 'Noida' ? 'selected' : '' }}>Noida</option>
                            <option value="Delhi" {{ old('city') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                            <option value="Jaipur" {{ old('city') == 'Jaipur' ? 'selected' : '' }}>Jaipur</option>
                        </select>
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="language">Language</label>
                        <div class="d-flex pt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="language[]" id="language_hindi" value="Hindi" {{ in_array('Hindi', old('language', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="language_hindi">Hindi</label>
                            </div>
                            <div class="form-check mx-5">
                                <input class="form-check-input" type="checkbox" name="language[]" id="language_english" value="English" {{ in_array('English', old('language', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="language_english">English</label>
                            </div>
                        </div>
                        @error('language')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <div class="d-flex pt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>
                            <div class="form-check mx-5">
                                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                        </div>
                        @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="photo">Photo:</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

   

    <script>
      function validateForm() {
          let isValid = true;
      
          // Clear previous errors
          document.querySelectorAll('.text-danger.client-error').forEach(el => el.remove());
      
          // Validate Name
          const name = document.getElementById("name");
          if (name.value.trim() === "") {
              showError(name, "Name is required.");
              isValid = false;
          }
      
          // Validate Email
          const email = document.getElementById("email");
          const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
          if (email.value.trim() === "") {
              showError(email, "Email is required.");
              isValid = false;
          } else if (!emailPattern.test(email.value.trim())) {
              showError(email, "Enter a valid email.");
              isValid = false;
          }
      
          // Validate City
          const city = document.getElementById("city");
          if (city.value === "") {
              showError(city, "Please select a city.");
              isValid = false;
          }
      
          // Validate Language
          const languages = document.querySelectorAll("input[name='language[]']:checked");
          if (languages.length === 0) {
              const langGroup = document.querySelector("input[name='language[]']").closest('.form-group');
              showGroupError(langGroup, "Please select at least one language.");
              isValid = false;
          }
      
          // Validate Gender
          const gender = document.querySelectorAll("input[name='gender']:checked");
          if (gender.length === 0) {
              const genderGroup = document.querySelector("input[name='gender']").closest('.form-group');
              showGroupError(genderGroup, "Please select your gender.");
              isValid = false;
          }

          // Validate Photo
    const photo = document.getElementById("photo");
    if (photo.files.length === 0) {
        showError(photo, "Please upload a photo.");
        isValid = false;
    } else {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(photo.files[0].type)) {
            showError(photo, "Only JPG, PNG, or GIF images are allowed.");
            isValid = false;
        }
    }
      
          // Validate Message
          const message = document.getElementById("message");
          if (message.value.trim() === "") {
              showError(message, "Message is required.");
              isValid = false;
          }
      
          return isValid; 
      }
      
      function showError(input, message) {
          const error = document.createElement("div");
          error.className = "text-danger client-error";
          error.innerText = message;
          input.parentElement.appendChild(error);
      }
      
      function showGroupError(group, message) {
          const error = document.createElement("div");
          error.className = "text-danger client-error mt-1";
          error.innerText = message;
          group.appendChild(error);
      }
      </script>
      
      
      
</body>
</html>