<template>
  <section>
    <div v-if="count === 0">Hệ thống phòng khám tư</div>
    <div v-for="n in name" v-else>
      {{n.tencs}}
    </div>
  </section>
</template>

<script type="text/javascript">
export default{
  data(){
    return{
      name:'',
      count:'',
    }
  },
  created(){
    this.tenpk()
  },
  methods:{
    tenpk(){
        this.axios.get('/tenphongkham')
        .then(response=>{
          this.name = response.data.tenpk
          this.count = response.data.count
        })

      }
  },
}
</script>