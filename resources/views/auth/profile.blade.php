@auth
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile | {{ Auth::user()->name }}</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .profile-header {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .profile-picture {
                width: 150px;
                height: 150px;
                object-fit: cover;
                border: 5px solid white;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .profile-upload-btn {
                position: relative;
                overflow: hidden;
                display: inline-block;
            }

            .profile-upload-btn input[type=file] {
                position: absolute;
                opacity: 0;
                right: 0;
                top: 0;
                cursor: pointer;
            }

            .profile-details {
                background-color: white;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>

    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Profile Header -->
                    <div class="profile-header p-4 mb-4 text-center">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('landing') }}" class="btn btn-light">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <h2 class="mb-0">My Profile</h2>
                            <div style="width: 100px;"></div> <!-- Spacer for alignment -->
                        </div>

                        <!-- Profile Picture with Upload -->
                        <div class="position-relative d-inline-block mb-3">
                            <img id="profile-preview"
                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=150&background=random' }}"
                                class="profile-picture rounded-circle">
                            <div class="mt-3">
                                <label for="profile-upload" class="btn btn-light profile-upload-btn">
                                    <i class="fas fa-camera me-2"></i>Change Photo
                                    <input id="profile-upload" type="file" name="photo" accept="image/*" class="d-none">
                                </label>
                            </div>
                        </div>

                        <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                        <p class="mb-0 opacity-75">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Profile Details -->
                    <div class="profile-details p-4">
                        <h4 class="mb-4 border-bottom pb-2">Profile Information</h4>

                        <form action="{{route('profile.updatePhoto')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Hidden file input for form submission -->
                            <input type="file" name="photo" id="form-photo-upload" class="d-none">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>

                            <!-- Additional fields can be added here -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Registration Date</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->created_at->format('d F Y') }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Updated</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->updated_at->diffForHumans() }}" readonly>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {
                // Preview image before upload
                $('#profile-upload').change(function () {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#profile-preview').attr('src', e.target.result);
                            // Also set the value for the form upload
                            $('#form-photo-upload').replaceWith($('#profile-upload').clone());
                        }

                        reader.readAsDataURL(this.files[0]);
                    }
                });

                // Handle form submission
                $('form').submit(function (e) {
                    e.preventDefault();

                    // You can add AJAX submission here or let it submit normally
                    // For AJAX submission:
                    /*
                    let formData = new FormData(this);

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Handle success
                            alert('Profile updated successfully!');
                        },
                        error: function(xhr) {
                            // Handle error
                            alert('Error updating profile.');
                        }
                    });
                    */

                    // For normal form submission (remove this if using AJAX)
                    this.submit();
                });
            });
        </script>
    </body>

    </html>
@endauth