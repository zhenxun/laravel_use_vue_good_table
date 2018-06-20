<template>
    <div>
      <vue-good-table
        theme="nocturnal"
        styleClass="vgt-table bordered condensed"
        :columns="columns"
        :rows="rows"
        :lineNumbers="true"
        :sort-options="{
          enabled: true,
          initialSortBy: {field: 'created_at', type: 'desc'}
        }"
        :search-options="{
            enabled: true,
            placeholder: 'Search this table',
          }"
        :pagination-options="{
            enabled: true,
            perPage: 5,
            position: 'bottom',
          }"
      >
      <template slot="table-row" slot-scope="props">
          <span v-if="props.column.field == 'edit_url'">
            <a :href="props.row.edit_url" title="edit"> <i class="fa fa-edit"/> </a>
          </span>
          <span v-else-if="props.column.field == 'delete_url'">
            <a v-on:click="destroy(props.row.id)" title="delete"> <i class="fa fa-trash-alt"/> </a>
          </span>
          <span v-else>
            {{props.formattedRow[props.column.field]}}
        </span>          
      </template>
      </vue-good-table>
    </div>
</template>
            
<script>
export default {
  name: "articles",
  data(){
    return {
      columns: [
        {
          label: 'Title',
          field: 'title',
        },
        {
          label: 'Created On',
          field: 'created_at',
          type: 'date',
          dateInputFormat: 'YYYY-MM-DD HH:mm:ss',
          dateOutputFormat: 'YYYY-MM-DD',
          width: '150px',
          thClass: 'vgt-center-align',
          tdClass: 'vgt-center-align'
        },
        {
          label: 'Edit',
          field: 'edit_url',
          html: true,
          width: '50px',
          thClass: 'vgt-center-align',
          tdClass: 'vgt-center-align'
        },
        {
          label: 'Delete',
          field: 'delete_url',
          html: true,
          width: '50px',
          thClass: 'vgt-center-align',
          tdClass: 'vgt-center-align cursor-pointer'
        }
      ],
      rows: [],
      totalRecords: 1000,
      serverParams: {
        page: 1,
        perPage: 10
      }
    };
  },
  mounted(){
      axios.get('/article/all').then(response => (
        this.rows = response.data
        )).catch(
        error => console.log(error)
      )
  },
  methods:{
    destroy: function (id){
      var r = confirm("Comfirm delete ?");
      if(r == true){
        axios.delete('/articles/'+ id).then(function(response){
          location.reload()
        }).catch(function(error){
          console.log(error)
        });
      }
    }
  }
};
</script>

