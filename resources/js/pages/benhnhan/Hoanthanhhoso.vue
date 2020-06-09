<template>
  <section class="bs-file-setting">
    <h1>Hoàn thành hồ sơ bệnh nhân</h1>
    <div class="container container-50">
      <div class="row no-margin-bottom">
        <form @submit.prevent="submit" method="post">
          <h3>Thông tin bệnh nhân</h3>
            <div class="row">
              <div class="col s12">
                <label for="tenbn">Họ và tên:</label>
                <input placeholder="Nhập họ và tên" id="tenbn" type="text" name="tenbn" v-model="fields.tenbn">
                <div v-if="errors && errors.tenbn" class="text-danger">{{ errors.tenbn[0] }}</div>
              </div>
              <div class="col s12">
                <p class="gender">Giới tính: 
                  <label>
                    <input name="gtbn" type="radio" value="Nam" v-model="fields.gtbn"/>
                    <span>Nam</span>
                  </label>
                  <label>
                    <input name="gtbn" type="radio" value="Nữ" v-model="fields.gtbn"/>
                    <span>Nữ</span>
                  </label>
                </p>
                <div v-if="errors && errors.gtbn" class="text-danger">{{ errors.gtbn[0] }}</div>
              </div>
              <div class="col s12">
                <label for="nsbn">Ngày sinh:</label>
                <input id="nsbn" type="date" name="nsbn"  v-model="fields.nsbn">
                <div v-if="errors && errors.nsbn" class="text-danger">{{ errors.nsbn[0] }}</div>
              </div>
              <div class="col s12">
                <label for="sodtbn">Số điện thoại:</label>
                <input placeholder="Nhập số điện thoại" id="sodtbn" type="number" name="sodtbn" v-model="fields.sodtbn">
                <div v-if="errors && errors.sodtbn" class="text-danger">{{ errors.sodtbn[0] }}</div>
              </div>
              <div class="col s12">
                <label for="socmbn">Số CMND:</label>
                <input placeholder="Nhập số chứng minh" id="socmbn" type="number" name="socmbn" v-model="fields.socmbn">
                <div v-if="errors && errors.socmbn" class="text-danger">{{ errors.socmbn[0] }}</div>
              </div>
              <div class="col s12">
                <label for="diachibn">Địa chỉ:</label>
                <input placeholder="Nhập địa chỉ" id="diachibn" type="text" name="diachibn" v-model="fields.diachibn">
                <div v-if="errors && errors.diachibn" class="text-danger">{{ errors.diachibn[0] }}</div>
              </div>
              <div v-if="existt" class="exist">Đã đăng kí thông tin bệnh nhân 
                <a href="/thong-tin-benh-nhan">Tại đây</a>
              </div>
              <div class="col s12 btn-save">
                  <button class="btn btn-primary">Lưu</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    data() {
      return {
        fields: {},
        error: '',
        errors: {},
        existt:'',
      }
    },
    // created(){
    //   this.submit()
    // },
    methods:{
      submit(){
        this.axios
        .post("luuhosobn", this.fields)
        .then(response => {
          //Kiểm tra bệnh nhân đã có thông tin chưa
          if(response.data === 'exist'){
            this.existt = true
          }
          else{
            this.$router.push('/thong-tin-benh-nhan');
            // this.$router.back();
          }
        })
        .catch(error =>{
          //Hiển thị lỗi
          console.log(error)
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        })
      },
    },
  }
</script>