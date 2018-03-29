<template>
    <div>
        <el-dialog title="提示" :visible="dialogVisible" :model="false">
            <el-form ref="form" :model="tmp" label-width="80px">
            <el-form-item label="标题">
            <el-input v-model="tmp.title"></el-input>
            </el-form-item>
            <el-form-item label="封面">
            <el-upload
            class="avatar-uploader"
            ref="upload"
            name="file"
            accept="jpg,png"
            :headers="header"
            :action="host+'/api/uploadImg'"
            :show-file-list="false"
            :multiple="false"
            :on-success="handleAvatarSuccess"
            :before-upload="beforeAvatarUpload">
            <img v-if="tmp.img" :src="tmp.img" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
            </el-form-item>
            <el-form-item label="描述">
            <el-input v-model="tmp.abs"></el-input>
            </el-form-item>

            <el-form-item label="正文">
            <vue-editor v-model="tmp.content"></vue-editor>
            </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="onSubmit">确 定</el-button>
            </span>
        </el-dialog>
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
                        width="220"
                        sortable>
                </el-table-column>
                <el-table-column width="120" label="封面">
                    <template slot-scope="scope">
                        <img style="max-height: 30px;" :src="scope.row.img">
                    </template>
                </el-table-column>
                <el-table-column
                        prop="abs"
                        label="摘要"
                        >
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
                <el-table-column label="操作" width="180">
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
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>
<script>
    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    import { VueEditor } from 'vue2-editor'
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
                host:window.host,
                header:{
                    'X-CSRF-TOKEN': csrf
                },
                dialogVisible:false,
                tmp:{
                    abs:"",
                    content:"",
                    created_at:"",
                    id:0,
                    img:"",
                    title:"",
                    type:"",
                    updated_at:"",
                    user:"",
                    user_id:0
                }
            }
        },
        mounted(){
            this.getList()
        },
        components: {
            VueEditor
        },
        methods:{
            getList(){
                let req = {
                    page:this.page.currentPage,
                    per_page:this.page.size,
                    type:'new',
                    isUser:false
                }
                let t = this
                this.$ajax.post(window.host+'/api/content/getPosts',req).then((res)=>{
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
            //打开编辑弹框
            handleEdit:function(a,b){
                this.tmp = b
                this.dialogVisible = true
            },
            add:function(){
                this.$router.push('/content/add')
            },
            //删除文章
            handleDelete:function(row){
                let t = this
                t.$confirm('是否删除《'+row.title+'》？','提示',{
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
            },
            handleAvatarSuccess:function (res) {
                this.tmp.img = res.data.local
            },
            beforeAvatarUpload(file) {
                console.log(file)
                const isJPG = file.type === 'image/jpeg'||file.type ==='image/png';
                const isLt1M = file.size / 1024 / 1024 < 1;
                if (!isJPG) {
                    this.$message.error('上传图片只能是 JPG 或 PNG 格式!');
                }
                if (!isLt1M) {
                    this.$message.error('上传图片大小不能超过 1MB!');
                }
                return isJPG && isLt1M;
            },
            //提交修改
            onSubmit:function(){
                if(!this.tmp.title){
                    this.$message.error('请输入文章标题！')
                    return false;
                }
                if(!this.tmp.content){
                    this.$message.error('文章内容不能为空！')
                    return false;
                }
                if(!this.tmp.img){
                    this.$message.error('请上传封面图片！')
                    return false;
                }
                let t = this
                if(t.tmp.id){
                    t.$ajax.post(window.host+'/api/editPost',t.tmp).then(
                        (res)=>{
                            if(res.data.err_code!=0){
                                t.$message.error(res.data.msg)
                            }else {
                                t.$message.success(res.data.msg)
                                t.clearInfo()
                                t.dialogVisible = false
                                t.getList()
                            }
                        }, (res)=>{
                            t.$message.error('请求失败！')
                        }
                    )
                }else {
                    t.$message.warning('无效的修改！')
                }
            },
            clearInfo:function(){
                this.tmp = {
                    abs:"",
                    content:"",
                    created_at:"",
                    id:0,
                    img:"",
                    title:"",
                    type:"",
                    updated_at:"",
                    user:"",
                    user_id:0
                }
                console.log(this.tmp)
            }
        }
    }
</script>