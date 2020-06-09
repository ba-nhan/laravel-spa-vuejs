<template>
    <section class="registering-user">
        <div class="container">
            <div class="row no-margin-bottom">
                <div class="form-register">
                    <h1>Đăng ký tài khoản</h1>
                    <form @submit.prevent="register" method="post">
                        <div class="row ">
                            <div class="col m4 s5 ali-right">
                                <label for="email">Email:</label>
                            </div>
                            <div class="col m8 s7">
                                <input type="text" name="email" id="email" v-model="email" placeholder="Nhập email">
                                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                            </div>
                            <div class="col m4 s5 ali-right">
                                <label for="password">Nhập mật khẩu:</label>
                            </div>
                            <div class="col m8 s7">
                                <input type="Password" name="password" id="password" v-model="password" placeholder="Nhập mật khẩu">
                                <div v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</div>
                            </div>
                            <div class="col m4 s5 ali-right">
                                <label for="password_confirmation">Nhập lại mật khẩu:</label>
                            </div>
                            <div class="col m8 s7">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu"  v-model="password_confirmation">
                                <div v-if="errors && errors.password_confirmation" class="text-danger">{{ errors.password_confirmation[0] }}</div>
                            </div>
                            <div class="col m4 s6 ali-right">
                                <label for="">Chọn loại tài khoản:</label>
                            </div>
                            <div class="col m8 s6 input-type">
                                <label>
                                    <input type="radio" name="role" value="2" v-model="role"><p>Bác sĩ</p>
                                </label>
                                <label>
                                    <input type="radio" name="role" value="1" v-model="role"><p>Bệnh nhân</p>
                                </label>
                                <div v-if="errors && errors.role" class="text-danger">{{ errors.role[0] }}</div>
                            </div>
                            <div class="row btn-regis">
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
  export default {
    data() {
      return {
        email: '',
        password: '',
        password_confirmation: '',
        role: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },
    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation,
            role: app.role,
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            //console.log hiển thị lỗi
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>