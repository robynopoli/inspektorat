<template>
    <div class="mt-5">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="" required autocomplete="off" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                <span class="invalid-feedback" role="alert" v-if="errors"><strong>{{ errors }}</strong></span>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            errors : '',
            is_loading : false,
            username : '',
            password : '',
        }
    },
    methods:{
        login(){
            localStorage.setItem('token', '1231');
        }
    }

}
</script>

<style scoped>

</style>
