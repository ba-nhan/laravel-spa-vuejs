<template>
  <section class="registering-user">
    <div class="container">
        <div class="row no-margin-bottom">
            <div class="form-register">
                <h1>Đăng nhập</h1>
                <div v-if="has_error" class="alert-danger">
                  <p>Đăng nhập thất bại
                    <button type="button" class="btn btn-primary" v-on:click="hide">&times;</button>
                  </p>
                </div>
                <form @submit.prevent="login" method="post">
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
                        <div class="row btn-regis">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
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
        email: null,
        password: null,
        has_error: false,
        error: '',
        errors: {},
        success: false,
      }
    },
    methods: {
      hide(){
        $('.alert-danger').fadeOut("fast")
      },
      login() {
        // Lấy redirect để điều hướng
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // Xử lý điểu hướng
            const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'bs' : 'bn'
            if(redirectTo === 'bn'){
              this.axios
              .get('/checkInfoBN')
              .then(response => { 
                  let check = response.data;
                  if ( check === 'exist') {
                    // this.$router.push({ path: '/thong-tin-benh-nhan' })
                    this.$router.back()
                  }
                  else{
                    this.$router.push({ path: '/luu-hoso-benh-nhan' })
                  }
              });
            }
            if(redirectTo === 'bs'){
              this.axios
              .get('/checkInfoBS')
              .then(response => { 
                  let check = response.data;
                  if ( check === 'exist') {
                    this.$router.push({ path: '/bac-si' })
                  }
                  else{
                    this.$router.push({ path: '/luu-hoso-bac-si' })
                  }
              });
            }
            // this.$router.push({name: redirectTo})
          },
          error: function(res) {
            //console.log hiển thị lỗi
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>