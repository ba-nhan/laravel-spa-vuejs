<template>
	<div id="each_thuoc" >
    {{ten}}
    <div class="each_thuoc">
      <div class="row row_name_thuoc">
        <div class="col m6 input-field">
          <input id="search" name="search" type="text" class="form-control validate search" v-model="tenthuoc" @keyup="tenThuoc()" list="tenthuoc">
          <label for="search">Tên thuốc</label>
          <datalist id="tenthuoc">
            <option v-for="kq in ketqua">{{kq.name}}</option>
          </datalist>
        </div>
        <div class="col m2 input-field">
          <input type="number" name="soluong1" id="soluong1" class="validate">
          <label for="soluong1">Số lượng</label>
        </div>

        <div class="col m4 pad_col">
          <label>
            <input type="radio" name="type_soluong1" value="goi" />
            <span>Gói</span>
          </label>
          <label>
            <input type="radio" name="type_soluong1" value="chai" />
            <span>Chai</span>
          </label>
          <label>
            <input type="radio" name="type_soluong1"  value="vien" />
            <span>Viên</span>
          </label>
        </div>
      </div>
      <div class="row row_uong">
        <div class="col m8 format_flex">
          <p>Uống mỗi ngày</p>  
          <p>
            <select class="browser-default" name="chon_1ngay1" >
              <option value="" disabled selected></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
          </p>
          <p>lần,</p>
          <p>mỗi lần</p>   
          <input type="text" class="validate" name="moilan1">
          <p></p>
          <p class="change_donvi1">đv</p>
        </div>
        <div class="col m4 checkbox_buoi">
          <label>
            <input type="checkbox" name="uongbuoi1[]" value="sáng" class="filled-in">
            <span>Sáng</span>
          </label>
          <label>
            <input type="checkbox" name="uongbuoi1[]" value="trưa" class="filled-in" >
            <span>Trưa</span>
          </label>
          <label>
            <input type="checkbox" name="uongbuoi1[]"  value="chiều" class="filled-in">
            <span>Chiều</span>
          </label>
        </div>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
  export default{
    data(){
      return{
        tenthuoc:'',
        ketqua:'',
      }
    },
    props:{
      ten: String,
    },
    methods:{
      tenThuoc(){
        this.axios
        .post("autocomplete", {
          keysearch: this.tenthuoc
        })
        .then(response =>{
          this.ketqua = response.data
        })
      },
    }
  }
</script>