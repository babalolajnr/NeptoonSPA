<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Live Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/home">Home</router-link>
              </li>
              <li class="breadcrumb-item active">Live Posts</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Live Posts</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div>
                  <b-table
                    hover
                    responsive
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    striped
                    head-variant="dark"
                    :busy="isBusy"
                    bordered
                    :items="items"
                    :fields="fields"
                    :current-page="ctx.currentPage"
                    :per-page="0"
                  >
                    <template v-slot:cell(index)="data">{{ data.index + 1 }}</template>
                    <template v-slot:cell(image)="data">
                      <img :src="data.value" fluid width="70" height="50" />
                    </template>
                    <template v-slot:cell(category)="data">{{ data.value.name }}</template>
                    <template v-slot:cell(published_at)="data">
                      {{ data.value | moment("calendar") }}
                      <!-- {{ data.value | moment("from", "now") }} -->
                    </template>
                    <template v-slot:cell(action)="data">
                      <div class="btn-group">
                        <button
                          @click="goToEditPage(data.item)"
                          title="Edit"
                          type="button"
                          class="btn btn-warning btn-flat"
                        >
                          <i class="fas fa-edit"></i>
                        </button>

                        <button
                          @click="deletePost(data.item)"
                          title="Delete"
                          type="button"
                          class="btn btn-danger btn-flat"
                        >
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <button
                          v-if="data.item.featured === 1"
                          @click="featurePost(data.item)"
                          title="feature"
                          type="button"
                          class="btn btn-success btn-flat"
                          disabled
                        >
                          <i class="fa fa-star" aria-hidden="true"></i>
                          
                        </button>
                        <button
                          v-else
                          @click="featurePost(data.item)"
                          title="feature"
                          type="button"
                          class="btn btn-success btn-flat"
                        >
                          <i class="fa fa-star" aria-hidden="true"></i>
                          
                        </button>
                      </div>
                    </template>
                    <template v-slot:table-busy>
                      <div class="text-center text-danger my-2">
                        <b-spinner class="align-middle"></b-spinner>
                        <strong>Loading...</strong>
                      </div>
                    </template>
                  </b-table>
                </div>
                <b-pagination
                  class="mt-3"
                  v-model="ctx.currentPage"
                  :total-rows="ctx.total"
                  :per-page="ctx.perPage"
                  @change="handlePageChange"
                ></b-pagination>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6"></div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
</template>
<script>
import Swal from "sweetalert2";
export default {
  data() {
    return {
      ctx: {
        currentPage: null,
        firstPageUrl: null,
        from: null,
        lastPage: null,
        lastPageUrl: null,
        nextPageUrl: null,
        path: null,
        perPage: null,
        prevPageUrl: null,
        to: null,
        total: null,
      },
      loading: false,
      isBusy: false,
      sortBy: "index",
      sortDesc: false,
      items: [],

      fields: [
        {
          key: "index",
          sortable: true,
        },
        {
          key: "title",
          sortable: true,
        },
        {
          key: "image",
        },
        {
          key: "category",
          label: "Category",
          sortable: true,
        },
        {
          key: "published_at",
          label: "Published",
          sortable: true,
        },
        {
          key: "action",
          label: "Action",
        },
      ],
    };
  },

  methods: {
    getLivePosts: function () {
      this.isBusy = true;
      axios
        .get("/api/post/livePosts")
        .then((result) => {
          this.items = result.data[0].data;

          this.ctx.currentPage = result.data[0].current_page;
          this.ctx.firstPageUrl = result.data[0].first_page_url;
          this.ctx.from = result.data[0].from;
          this.ctx.lastPage = result.data[0].last_page;
          this.ctx.lastPageUrl = result.data[0].last_page_url;
          this.ctx.nextPageUrl = result.data[0].next_page_url;
          this.ctx.path = result.data[0].path;
          this.ctx.perPage = result.data[0].per_page;
          this.ctx.prevPageUrl = result.data[0].prev_page_url;
          this.ctx.to = result.data[0].to;
          this.ctx.total = result.data[0].total;
        })
        .catch((err) => {
          this.errorModal();
        });
      this.isBusy = false;
    },
    handlePageChange(value) {
      this.isBusy = true;

      this.ctx.current_page = value;

      axios
        .get("/api/post/livePosts?page=" + this.ctx.current_page)
        .then((result) => {
          this.items = result.data[0].data;

          this.ctx.firstPageUrl = result.data[0].first_page_url;
          this.ctx.from = result.data[0].from;
          this.ctx.lastPage = result.data[0].last_page;
          this.ctx.lastPageUrl = result.data[0].last_page_url;
          this.ctx.nextPageUrl = result.data[0].next_page_url;
          this.ctx.path = result.data[0].path;
          this.ctx.perPage = result.data[0].per_page;
          this.ctx.prevPageUrl = result.data[0].prev_page_url;
          this.ctx.to = result.data[0].to;
          this.ctx.total = result.data[0].total;
        })
        .catch((err) => {
          this.errorModal();
        });
      this.isBusy = false;
    },
    errorModal() {
      Swal.fire({
        title: "Error!",
        text: "There may be an error😢. Try Again",
        icon: "error",
        confirmButtonText: "Okay",
      });
    },
    goToEditPage(post) {
      this.$router.push({
        name: "editpost",
        params: {
          id: post.id,
        },
      });
    },
    deletePost(post) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.isBusy = true;
          axios
            .post("/api/posts/delete/" + post.id)
            .then((response) => {
              if (response.status === 200) {
                this.getLivePosts();
                Swal.fire(
                  "Deleted!",
                  "Post Deleted Successfully!!😀",
                  "success"
                );
              }
            })
            .catch((err) => {
              this.errorModal();
            });
          this.isBusy = false;
        }
      });
    },
    featurePost(post) {
      this.isBusy = true;
      axios
        .post("/api/posts/feature/" + post.id, {
          _method: "PATCH",
        })
        .then((response) => {
          if (response.status === 200) {
            this.getLivePosts();
            Swal.fire("Featured!", "Post Featured Successfully!!😀", "success");
          }
        })
        .catch((err) => {
          this.errorModal();
        });
      this.isBusy = false;
    },
  },
  created: function () {
    this.getLivePosts();
  },
};
</script>
