<template>

	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-6" style="display: flex; justify-content:space-between;">
					<button class="btn btn-primary" @click="toggleServerStatus">
						Toggle
					</button>
				</div>
				<div class="col-md-6">
					<h3>Server Status : {{ formatStatus() }}</h3>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<ul class="list-group">
						<li class="list-group-item" v-for="response in responses">
							{{ response.id }} {{ response.msg }}
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>

</template>

<script>

	export default{
		data(){
			return {
				status : 0,
				responses : [],
			};
		},
		mounted(){
			setInterval(
				()=>{
					if(this.status){
						axios.get('/post-data').then(
							(response)=>{
								this.responses.push({
									'id' : response.data,
									'msg' : " successfully sent"
								});
							}
						).catch(
						(error)=>{
							this.responses.push({
								'id' : '-',
								'msg' : ' unable to send'
							});
						}
						);
					}
				}
				,5000);
		},
		methods : {
			formatStatus(){
				return this.status == 0 ? 'Not Running' : 'Running';
			},
			toggleServerStatus(){
				if(this.status == 0)
					this.status = 1;
				else
					this.status = 0;
			},
		}
	}
</script>
