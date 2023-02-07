<template>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Registration form</h2>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-lg-7">
                    <form class="needs-validation" novalidate="">
                        <h4 class="mb-3">Personal info</h4>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">First name</label>
                                <input type="text"
                                       class="form-control"
                                       id="name"
                                       placeholder=""
                                       value=""
                                       name="name"
                                >
                                <div class="invalid-feedback d-block">
                                    Valid name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text"
                                       class="form-control"
                                       id="surname"
                                       placeholder=""
                                       value=""
                                       required=""
                                       name="surname"
                                >
                                <div class="invalid-feedback">
                                    Valid surname is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="username" placeholder="Username"
                                           required="">
                                    <div class="invalid-feedback">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email <span
                                    class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <label class="form-label" style="margin-right: 10px">Sex</label>
                                    <div class="form-check" style="margin-right: 10px">
                                        <input id="man" name="sex" type="radio" class="form-check-input" value="1"
                                               checked=""
                                               required="">
                                        <label class="form-check-label" for="credit">Man</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="woman" name="sex" type="radio" class="form-check-input"
                                               value="2"
                                               required="">
                                        <label class="form-check-label" for="debit">Woman</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a valid sex.
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="position" class="form-label">Position</label>
                                <select class="form-select" id="position" required="">
                                    <option value="">Choose...</option>
                                    <option>United States</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid position.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h4 class="mb-3">Personal image</h4>
                        <div class="file-upload">
                            <button class="file-upload-btn" type="button" @click="addButtonClickEvent">Add Image
                            </button>

                            <div class="image-upload-wrap" :class="{'d-none': isImageUpload}">
                                <input ref="imageInput" class="file-upload-input" type='file' @change="previewImage"
                                       accept="image/*"/>
                                <div class="drag-text">
                                    <h3>Drag and drop a file or select add Image</h3>
                                </div>
                            </div>
                            <div class="file-upload-content" :class="{'d-none': !isImageUpload}">
                                <img class="file-upload-image" :src="selectedImage" alt="your image"/>
                                <div class="image-title-wrap">
                                    <button type="button" @click="removeUpload" class="remove-image">Remove <span
                                        class="image-title">Uploaded Image</span></button>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="btn btn-dark btn-lg float-end" type="submit">Sign up</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isImageUpload: false,
            selectedImage: null,
            selectedImageFile: null,
        }
    },
    methods: {
        addButtonClickEvent: function () {
            this.$refs.imageInput.click();
        },
        previewImage: function (e) {
            this.selectedImageFile = e.target.files[0];
            this.selectedImage = URL.createObjectURL(this.selectedImageFile);
            this.isImageUpload = true;
            console.log(this.isImageUpload)
        },
        removeUpload: function () {
            this.isImageUpload = false;
        }
    },
    mounted() {
        console.log(this.isImageUpload)
    }
}
</script>
