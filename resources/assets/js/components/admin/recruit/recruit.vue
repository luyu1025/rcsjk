<template>
    <div>
        <div class="list-top">
            <el-button size="mini" @click="add()">添加</el-button>
        </div>
        <div class="list-body">
            <el-table
                    :data="tableData"
                    style="width: 100%; height: 100%;"
                    :default-sort = "{prop: 'date', order: 'descending'}"
            >
                <el-table-column
                        type="index"
                        width="50">
                </el-table-column>
                <el-table-column
                        prop="title"
                        label="标题"
                        width="180"
                        sortable>
                </el-table-column>
                <el-table-column width="120" label="封面">
                    <template slot-scope="scope">
                        <img style="max-height: 30px;" :src="scope.row.img">
                    </template>
                </el-table-column>
                <el-table-column
                        prop="user"
                        label="作者"
                        width="150"
                        sortable>
                </el-table-column>
                <el-table-column
                        prop="created_at"
                        label="日期"
                        sortable
                        width="180">
                </el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <el-button
                                size="mini"
                                @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
        <div class="list-bottom">
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="page.currentPage"
                    :page-sizes="[10, 30, 50, 100]"
                    :page-size="page.size"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="page.total">
            </el-pagination>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg:this.$route.name,
                tableData: [],
                page:{
                    size:10,
                    total:0,
                    currentPage:1
                },
            }
        },
        mounted(){
            this.getList()
        },
        methods:{
            getList(){
                let req = {
                    page:this.page.currentPage,
                    per_page:this.page.size
                }
                let t = this
                this.$ajax.post(window.host+'/api/posts',req).then((res)=>{
                    t.tableData = res.data.data
                    t.page.total = res.data.total
                },(res)=>{})
            },
            formatter(row, column) {
                return row.address;
            },
            handleSizeChange:function (a) {
                this.page.size = a
                this.page.currentPage = 1
                this.getList()
            },
            handleCurrentChange:function (a) {
                this.page.currentPage = a
                this.getList()
            },
            handleEdit:function(a,b){
                console.log(a,b)
            },
            add:function(){
                this.$router.push('/content/add')
            },
            handleDelete:function(row){
                let t = this
                t.$confirm('是否删除《'+row.name+'》？','提示',{
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(()=>{
                    this.$ajax.post(window.host+'/api/delPost',{id:row.id}).then(
                        (res)=>{
                            console.log(res.data)
                            if(res.data.err_code==0){
                                t.getList();
                                t.$message.success('删除成功！')
                            }else{
                                t.$message.warning(res.data.msg)
                                t.getList();
                            }
                        },(res)=>{}
                    )
                },).catch(() => {})
            }
        }
    }
</script>