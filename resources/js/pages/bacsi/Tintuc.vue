<template>
  	<section class="showNews">
		<div class="container">
			<div class="row">
				<h3 v-if="count === 0">Không có thông báo</h3>
				<h3 v-else>Danh sách các tin tức</h3>
				<div class="box_news" v-for="n in news">
					<h5>{{n.tieude}}</h5>
					<p class="dangluc" ><span>Đăng lúc: </span>{{moment(n.thoigian).format("HH:mm DD/MM/YYYY") }}</p>
					<p v-html="getNoidung(n.noidung)"></p>
				</div>
			</div>
		</div>

	</section>
</template>
<script type="text/javascript">
  	import moment from 'moment'
	export default{
		data(){
			return{
				news:'',
				count:'',
				namethuoc:'',
			}
		},
		created(){
			this.tintuc()
		},
		methods:{
			moment,
			tintuc(){
				this.axios.get("tintuc")
				.then(response=>{
					this.news = response.data.news
					this.count = response.data.count
				})
			},
		    getNoidung(string) {
		    	string = string.replace("\n", "<br>");
                return string;
            }
		}
	}
</script>