<template>
  <section class="save_result_khambenh">
    <div class="container">
      <div class="row">
        <h3>Lưu kết quả khám chữa bệnh <span v-if="check === 'Daluu'" >(Đã lưu)</span> </h3>
        <div class="lichsu">
          <router-link :to="{
            name:'lichsukb',
            params:{
              iddk: this.$route.params.iddk, 
            }
          }">Lịch sử khám của bệnh nhân</router-link>
        </div>
        <div class="box" v-for="data in ketquals" v-if="check === 'Chualuu'">
          <div class="row">
            <h4>{{data.tencs}}</h4>
            <div class="col m6 s6">
              <p>Tên bệnh nhân: <span>{{data.tenbn}}</span></p>
            </div>
            <div class="col m6 s6">
              <p>Số khám bệnh: <span>{{data.sokb}}</span></p>
            </div>

            <form method="POST" @submit.prevent="submit">
              <div class="col m12 s12">
                <label for="chuandoan"><p>Chuẩn đoán:</p></label>
                <input placeholder="Nhập chuẩn đoán . . ." id="chuandoan" type="text" v-model="fields.chuandoan" >
                <div v-if="errors.chuandoan" class="text-danger">{{ errors.chuandoan[0] }}</div>
              </div>
              <div class="col m12 s12 search_tenthuoc">
                <p>Toa thuốc:</p>
                
                <div class="each_thuoc1">
                  <div class="text-danger" v-if="errors.search1 || errors.soluong1 || errors.type_soluong1 || errors.chon_1ngay1 || errors.moilan1 || errors.uongbuoi1">Trường thuốc đầu tiên bắt buộc(*)</div>
                  <div class="row row_name_thuoc">
                    <div class="col m6 s8 input-field">
                      <input id="search1" type="text" class="form-control validate search" v-model="fields.search1" @keyup="tenThuoc1()" list="tenthuoc1">
                      <label for="search1">Tên thuốc</label>
                      <datalist id="tenthuoc1">
                        <option v-for="kq in ketqua1">{{kq.name}}</option>
                      </datalist>
                    </div>
                    <div class="col m2 s4 input-field">
                      <input type="number" name="soluong1" id="soluong1" class="validate" v-model="fields.soluong1">
                      <label for="soluong1">Số lượng</label>
                    </div>
                    <div class="col m4 s12 pad_col">
                      <label>
                        <input type="radio" value="goi" v-model="fields.type_soluong1" v-on:click="seen = 1"/>
                        <span>Gói</span>
                      </label>
                      <label>
                        <input type="radio" value="chai" v-model="fields.type_soluong1" v-on:click="seen = 2"/>
                        <span>Chai</span>
                      </label>
                      <label>
                        <input type="radio"  value="vien" v-model="fields.type_soluong1" v-on:click="seen = 3"/>
                        <span>Viên</span>
                      </label>
                    </div>
                  </div>
                  <div class="row row_uong">
                    <div class="col m4 s12 format_flex">
                      <p>Uống mỗi ngày</p>  
                      <p>
                        <select class="browser-default" name="chon_1ngay1" v-model="fields.chon_1ngay1">
                          <option value="" disabled selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                      </p>
                      <p>lần,</p>
                    </div>
                    <div class="col m4 s12 format_flex">
                      <p>mỗi lần</p>   
                      <input type="text" class="validate" name="moilan1" v-model="fields.moilan1"><p></p>
                      <p v-if="seen === 0">đv</p>
                      <p v-if="seen === 1">gói</p>
                      <p v-if="seen === 2">ml</p>
                      <p v-if="seen === 3">viên</p>
                    </div>
                    <div class="col m4 s12 checkbox_buoi">
                      <label>
                        <input type="checkbox" value="sáng" class="filled-in" v-model="uongbuoi1">
                        <span>Sáng</span>
                      </label>
                      <label>
                        <input type="checkbox" value="trưa" class="filled-in" v-model="uongbuoi1">
                        <span>Trưa</span>
                      </label>
                      <label>
                        <input type="checkbox" value="chiều" class="filled-in" v-model="uongbuoi1">
                        <span>Chiều</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="each_thuoc2">
                  <div class="text-danger" v-if="errors.search2 || errors.soluong2 || errors.type_soluong2 || errors.chon_1ngay2 || errors.moilan2 || errors.uongbuoi2">Điền đầy đủ các trường thông tin (*) </div>
                  <div class="row row_name_thuoc">
                    <div class="col m6 s8 input-field">
                      <input id="search2" type="text" class="form-control validate search" v-model="fields.search2" @keyup="tenThuoc2()" list="tenthuoc2">
                      <label for="search2">Tên thuốc</label>
                      <datalist id="tenthuoc2">
                        <option v-for="kq2 in ketqua2">{{kq2.name}}</option>
                      </datalist>
                    </div>
                    <div class="col m2 s4 input-field">
                      <input type="number" id="soluong2" class="validate" v-model="fields.soluong2">
                      <label for="soluong2">Số lượng</label>
                    </div>
                    <div class="col m4 s12 pad_col">
                      <label>
                        <input type="radio" value="goi" v-model="fields.type_soluong2" v-on:click="seen2 = 1"/>
                        <span>Gói</span>
                      </label>
                      <label>
                        <input type="radio" value="chai" v-model="fields.type_soluong2" v-on:click="seen2 = 2"/>
                        <span>Chai</span>
                      </label>
                      <label>
                        <input type="radio"  value="vien" v-model="fields.type_soluong2" v-on:click="seen2 = 3"/>
                        <span>Viên</span>
                      </label>
                    </div>
                  </div>
                  <div class="row row_uong">
                    <div class="col m4 s12 format_flex">
                      <p>Uống mỗi ngày</p>  
                      <p>
                        <select class="browser-default" v-model="fields.chon_1ngay2">
                          <option value="" disabled selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                      </p>
                      <p>lần,</p>
                      
                    </div>
                    <div class="col m4 s12 format_flex"> 
                      <p>mỗi lần</p>
                      <input type="text" class="validate" v-model="fields.moilan2"><p></p>
                      <p v-if="seen2 === 0">đv</p>
                      <p v-if="seen2 === 1">gói</p>
                      <p v-if="seen2 === 2">ml</p>
                      <p v-if="seen2 === 3">viên</p>
                    </div>
                    <div class="col m4 s12 checkbox_buoi">
                      <label>
                        <input type="checkbox" value="sáng" class="filled-in" v-model="uongbuoi2">
                        <span>Sáng</span>
                      </label>
                      <label>
                        <input type="checkbox" value="trưa" class="filled-in" v-model="uongbuoi2">
                        <span>Trưa</span>
                      </label>
                      <label>
                        <input type="checkbox" value="chiều" class="filled-in" v-model="uongbuoi2">
                        <span>Chiều</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="each_thuoc3">
                  <div class="text-danger" v-if="errors.search3 || errors.soluong3 || errors.type_soluong3 || errors.chon_1ngay3 || errors.moilan3 || errors.uongbuoi3">Điền đầy đủ các trường thông tin (*) </div>
                  <div class="row row_name_thuoc">
                    <div class="col m6 s8 input-field">
                      <input id="search3" type="text" class="form-control validate search" v-model="fields.search3" @keyup="tenThuoc3()" list="tenthuoc3">
                      <label for="search3">Tên thuốc</label>
                      <datalist id="tenthuoc3">
                        <option v-for="kq3 in ketqua3">{{kq3.name}}</option>
                      </datalist>
                    </div>
                    <div class="col m2 s4 input-field">
                      <input type="number" id="soluong3" class="validate" v-model="fields.soluong3">
                      <label for="soluong3">Số lượng</label>
                    </div>
                    <div class="col m4 s12 pad_col">
                      <label>
                        <input type="radio" value="goi" v-model="fields.type_soluong3" v-on:click="seen3 = 1"/>
                        <span>Gói</span>
                      </label>
                      <label>
                        <input type="radio" value="chai" v-model="fields.type_soluong3" v-on:click="seen3 = 2"/>
                        <span>Chai</span>
                      </label>
                      <label>
                        <input type="radio"  value="vien" v-model="fields.type_soluong3" v-on:click="seen3 = 3"/>
                        <span>Viên</span>
                      </label>
                    </div>
                  </div>
                  <div class="row row_uong">
                    <div class="col m4 s12 format_flex">
                      <p>Uống mỗi ngày</p>  
                      <p>
                        <select class="browser-default" v-model="fields.chon_1ngay3">
                          <option value="" disabled selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                      </p>
                      <p>lần,</p>
                    </div>
                    <div class="col m4 s12 format_flex">
                      <p>mỗi lần</p>   
                      <input type="text" class="validate" v-model="fields.moilan3"><p></p>
                      <p v-if="seen3 === 0">đv</p>
                      <p v-if="seen3 === 1">gói</p>
                      <p v-if="seen3 === 2">ml</p>
                      <p v-if="seen3 === 3">viên</p>
                    </div>
                    <div class="col m4 s12 checkbox_buoi">
                      <label>
                        <input type="checkbox" value="sáng" class="filled-in" v-model="uongbuoi3">
                        <span>Sáng</span>
                      </label>
                      <label>
                        <input type="checkbox" value="trưa" class="filled-in" v-model="uongbuoi3">
                        <span>Trưa</span>
                      </label>
                      <label>
                        <input type="checkbox" value="chiều" class="filled-in" v-model="uongbuoi3">
                        <span>Chiều</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="each_thuoc4">
                  <div class="text-danger" v-if="errors.search4 || errors.soluong4 || errors.type_soluong4 || errors.chon_1ngay4 || errors.moilan4 || errors.uongbuoi4">Điền đầy đủ các trường thông tin (*) </div>
                  <div class="row row_name_thuoc">
                    <div class="col m6 s8 input-field">
                      <input id="search4" type="text" class="form-control validate search" v-model="fields.search4" @keyup="tenThuoc4()" list="tenthuoc4">
                      <label for="search4">Tên thuốc</label>
                      <datalist id="tenthuoc4">
                        <option v-for="kq4 in ketqua4">{{kq4.name}}</option>
                      </datalist>
                    </div>
                    <div class="col m2 s4 input-field">
                      <input type="number" id="soluong4" class="validate" v-model="fields.soluong4">
                      <label for="soluong4">Số lượng</label>
                    </div>
                    <div class="col m4 s12 pad_col">
                      <label>
                        <input type="radio" value="goi" v-model="fields.type_soluong4" v-on:click="seen4 = 1"/>
                        <span>Gói</span>
                      </label>
                      <label>
                        <input type="radio" value="chai" v-model="fields.type_soluong4" v-on:click="seen4 = 2"/>
                        <span>Chai</span>
                      </label>
                      <label>
                        <input type="radio"  value="vien" v-model="fields.type_soluong4" v-on:click="seen4 = 3"/>
                        <span>Viên</span>
                      </label>
                    </div>
                  </div>
                  <div class="row row_uong">
                    <div class="col m4 s12 format_flex">
                      <p>Uống mỗi ngày</p>  
                      <p>
                        <select class="browser-default" v-model="fields.chon_1ngay4">
                          <option value="" disabled selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                      </p>
                      <p>lần,</p>
                    </div>
                    <div class="col m4 s12 format_flex">
                      <p>mỗi lần</p>   
                      <input type="text" class="validate" v-model="fields.moilan4"><p></p>
                      <p v-if="seen4 === 0">đv</p>
                      <p v-if="seen4 === 1">gói</p>
                      <p v-if="seen4 === 2">ml</p>
                      <p v-if="seen4 === 3">viên</p>
                    </div>
                    <div class="col m4 s12 checkbox_buoi">
                      <label>
                        <input type="checkbox" value="sáng" class="filled-in" v-model="uongbuoi4">
                        <span>Sáng</span>
                      </label>
                      <label>
                        <input type="checkbox" value="trưa" class="filled-in" v-model="uongbuoi4">
                        <span>Trưa</span>
                      </label>
                      <label>
                        <input type="checkbox" value="chiều" class="filled-in" v-model="uongbuoi4">
                        <span>Chiều</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="each_thuoc5">
                  <div class="text-danger" v-if="errors.search5 || errors.soluong5 || errors.type_soluong5 || errors.chon_1ngay5 || errors.moilan5 || errors.uongbuoi5">Điền đầy đủ các trường thông tin (*) </div>
                  <div class="row row_name_thuoc">
                    <div class="col m6 s8 input-field">
                      <input id="search5" type="text" class="form-control validate search" v-model="fields.search5" @keyup="tenThuoc5()" list="tenthuoc5">
                      <label for="search5">Tên thuốc</label>
                      <datalist id="tenthuoc5">
                        <option v-for="kq5 in ketqua5">{{kq5.name}}</option>
                      </datalist>
                    </div>
                    <div class="col m2 s4 input-field">
                      <input type="number" id="soluong5" class="validate" v-model="fields.soluong5">
                      <label for="soluong5">Số lượng</label>
                    </div>
                    <div class="col m4 s12 pad_col">
                      <label>
                        <input type="radio" value="goi" v-model="fields.type_soluong5" v-on:click="seen5 = 1"/>
                        <span>Gói</span>
                      </label>
                      <label>
                        <input type="radio" value="chai" v-model="fields.type_soluong5" v-on:click="seen5 = 2"/>
                        <span>Chai</span>
                      </label>
                      <label>
                        <input type="radio"  value="vien" v-model="fields.type_soluong5" v-on:click="seen5 = 3"/>
                        <span>Viên</span>
                      </label>
                    </div>
                  </div>
                  <div class="row row_uong">
                    <div class="col m4 s12 format_flex">
                      <p>Uống mỗi ngày</p>  
                      <p>
                        <select class="browser-default" v-model="fields.chon_1ngay5">
                          <option value="" disabled selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                      </p>
                      <p>lần,</p>
                    </div>
                    <div class="col m4 s12 format_flex">
                      <p>mỗi lần</p>   
                      <input type="text" class="validate" v-model="fields.moilan5"><p></p>
                      <p v-if="seen5 === 0">đv</p>
                      <p v-if="seen5 === 1">gói</p>
                      <p v-if="seen5 === 2">ml</p>
                      <p v-if="seen5 === 3">viên</p>
                    </div>
                    <div class="col m4 s12 checkbox_buoi">
                      <label>
                        <input type="checkbox" value="sáng" class="filled-in" v-model="uongbuoi5">
                        <span>Sáng</span>
                      </label>
                      <label>
                        <input type="checkbox" value="trưa" class="filled-in" v-model="uongbuoi5">
                        <span>Trưa</span>
                      </label>
                      <label>
                        <input type="checkbox" value="chiều" class="filled-in" v-model="uongbuoi5">
                        <span>Chiều</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="each_thuoc6">
                  <div class="text-danger" v-if="errors.search6 || errors.soluong6 || errors.type_soluong6 || errors.chon_1ngay6 || errors.moilan6 || errors.uongbuoi6">Điền đầy đủ các trường thông tin (*) </div>
                  <div class="row row_name_thuoc">
                    <div class="col m6 s8 input-field">
                      <input id="search6" type="text" class="form-control validate search" v-model="fields.search6" @keyup="tenThuoc6()" list="tenthuoc6">
                      <label for="search6">Tên thuốc</label>
                      <datalist id="tenthuoc6">
                        <option v-for="kq6 in ketqua6">{{kq6.name}}</option>
                      </datalist>
                    </div>
                    <div class="col m2 s4 input-field">
                      <input type="number" id="soluong6" class="validate" v-model="fields.soluong6">
                      <label for="soluong6">Số lượng</label>
                    </div>
                    <div class="col m4 s12 pad_col">
                      <label>
                        <input type="radio" value="goi" v-model="fields.type_soluong6" v-on:click="seen6 = 1"/>
                        <span>Gói</span>
                      </label>
                      <label>
                        <input type="radio" value="chai" v-model="fields.type_soluong6" v-on:click="seen6 = 2"/>
                        <span>Chai</span>
                      </label>
                      <label>
                        <input type="radio"  value="vien" v-model="fields.type_soluong6" v-on:click="seen6 = 3"/>
                        <span>Viên</span>
                      </label>
                    </div>
                  </div>
                  <div class="row row_uong">
                    <div class="col m4 s12 format_flex">
                      <p>Uống mỗi ngày</p>  
                      <p>
                        <select class="browser-default" v-model="fields.chon_1ngay6">
                          <option value="" disabled selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                      </p>
                      <p>lần,</p>
                    </div>
                    <div class="col m4 s12 format_flex">
                      <p>mỗi lần</p>   
                      <input type="text" class="validate" v-model="fields.moilan6"><p></p>
                      <p v-if="seen6 === 0">đv</p>
                      <p v-if="seen6 === 1">gói</p>
                      <p v-if="seen6 === 2">ml</p>
                      <p v-if="seen6 === 3">viên</p>
                    </div>
                    <div class="col m4 s12 checkbox_buoi">
                      <label>
                        <input type="checkbox" value="sáng" class="filled-in" v-model="uongbuoi6">
                        <span>Sáng</span>
                      </label>
                      <label>
                        <input type="checkbox" value="trưa" class="filled-in" v-model="uongbuoi6">
                        <span>Trưa</span>
                      </label>
                      <label>
                        <input type="checkbox" value="chiều" class="filled-in" v-model="uongbuoi6">
                        <span>Chiều</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col m12 s12">
                <label for="loidan"><p>Lời dặn: <span class="warning">(Không bắt buộc)</span> </p></label>
                <input placeholder="Nhập lời dặn (nếu có)" id="loidan" type="text" name="loidan"  v-model="fields.loidan">
              </div>
              <div class="col m12 s12">
                <label for="taikham"><p>Tái khám: <span class="warning">(Không bắt buộc)</span></p>
                <input id="taikham" type="date" name="taikham" v-model="fields.taikham"> 
              </label>

              </div>
              <div class="col m12 s12 btn-save">
                <button class="btn btn-primary">Lưu kết quả</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script type="text/javascript">
  export default{
    data(){
      return{
        ketquals:'',
        fields:{},
        errors: {},
        check:'',
        seen:0,
        seen2:0,
        seen3:0,
        seen4:0,
        seen5:0,
        seen6:0,
        ketqua1:'',
        ketqua2:'',
        ketqua3:'',
        ketqua4:'',
        ketqua5:'',
        ketqua6:'',
        uongbuoi1:[],
        uongbuoi2:[],
        uongbuoi3:[],
        uongbuoi4:[],
        uongbuoi5:[],
        uongbuoi6:[],
      }
    },
    created(){
      this.infor_dangkylayso()
      this.checkSaved()
      
    },
    mounted () {
    },
    // updated(){
    //   this.infor_dangkylayso()
    //   this.checkSaved()
    // },
    methods:{
      infor_dangkylayso(){
        this.axios.post("ketqualayso",{
          iddk: this.$route.params.iddk
        })
        .then(response =>{
          this.ketquals = response.data
        })
      },
      tenThuoc1(){
        this.axios
        .post("autocomplete", {
          keysearch: this.fields.search1
        })
        .then(response =>{
          this.ketqua1 = response.data
        })
      },
      tenThuoc2(){
        this.axios
        .post("autocomplete", {
          keysearch: this.fields.search2
        })
        .then(response =>{
          this.ketqua2 = response.data
        })
      },
      tenThuoc3(){
        this.axios
        .post("autocomplete", {
          keysearch: this.fields.search3
        })
        .then(response =>{
          this.ketqua3 = response.data
        })
      },
      tenThuoc4(){
        this.axios
        .post("autocomplete", {
          keysearch: this.fields.search4
        })
        .then(response =>{
          this.ketqua4 = response.data
        })
      },
      tenThuoc5(){
        this.axios
        .post("autocomplete", {
          keysearch: this.fields.search5
        })
        .then(response =>{
          this.ketqua5 = response.data
        })
      },
      tenThuoc6(){
        this.axios
        .post("autocomplete", {
          keysearch: this.fields.search6
        })
        .then(response =>{
          this.ketqua6 = response.data
        })
      },
      submit(){
        this.axios.post("luuKetquakb", {
          fields:this.fields,
          iddk: this.$route.params.iddk,
          uongbuoi1: this.uongbuoi1,
          uongbuoi2: this.uongbuoi2,
          uongbuoi3: this.uongbuoi3,
          uongbuoi4: this.uongbuoi4,
          uongbuoi5: this.uongbuoi5,
          uongbuoi6: this.uongbuoi6,
        })
        .then(response =>{
          if(response.data.status ==="Ok"){
            alert("Lưu thành công");
          }
        })
        .catch(error =>{
          console.log(error)
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        })
      },
      checkSaved(){
        this.axios.post("checkLuukqkb",{
          iddk: this.$route.params.iddk,
        })
        .then(response=>{
          this.check = response.data.ketquaCheck
        })
      }
    }
  }
</script>