<template>
  	<section class="add_news_bs">
		<div class="container container-80">
			<div class="row">
				<h3>Thêm thông báo về phòng khám</h3>
				<form method="post" @submit.prevent="submit">
					<div class="row">
						<div class="col m12 s12">
				        	<label for="tieude"><p>Tiêu đề</p></label>
				          	<input placeholder="Nhập tiêu đề" id="tieude" type="text" v-model="fields.tieude">
				          	<div v-if="errors.tieude" class="text-danger">{{ errors.tieude[0] }}</div>
				        </div>
				        <div class="col m12 s12">
				        	<label for="noidung"><p>Nội dung</p></label>
				        	<textarea id="noidung" placeholder="Nhập nội dung thông báo" type="text" rows="5" cols="20" v-model="fields.noidung"></textarea>
				          	<div v-if="errors.noidung" class="text-danger">{{ errors.noidung[0] }}</div>
				        </div>
				        <div class="col m12 s12 btn-save">
				            <button class="btn btn-primary">Lưu thông báo</button>
				        </div>
			        </div>
				</form>
			</div>
		</div>
	</section>
</template>
<script type="text/javascript">
	export default{
		data(){
			return{
				fields:{},
				errors:{},
			}
		},
		methods:{
			submit(){
				this.axios.post("luutin", this.fields)
				.then(response=>{
					if(response.data.status ==='luuthanhcong'){
						alert("Đăng tin thành công!")
						this.$router.push({ path: '/bac-si/tin-tuc' })
					}else{
						alert("Phòng khám chưa đăng kí thông tin")
                    	this.$router.push({ path: '/luu-hoso-bac-si' })
					}
				})
				.catch(error=>{
					if (error.response.status === 422) {
			          this.errors = error.response.data.errors || {};
			        }
				})
			}
		}
	}
</script>
