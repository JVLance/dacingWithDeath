<template>
  <div>
    <div v-show="cargando">
      <center>
        <icon name="spinner" pulse scale="4"></icon>
        <p><h3>Loading</h3></p>
      </center>
    </div>
    <div v-show="!cargando">
      <filter-bar  @filter="onFilterSet" @reset="onFilterReset"></filter-bar>
      <vuetable ref="vuetable"
        :api-url="dataurl"
        :fields="fields"
        pagination-path=""
        @vuetable:pagination-data="onPaginationData"
        :append-params="moreParams"
        @vuetable:loading="iniciarCarga"
        @vuetable:loaded="terminarCarga"
        @vuetable:load-success="consultaExitosa"
        @vuetable:load-error="consultaFallida"
      ></vuetable>
      <div class="vuetable-pagination ui basic segment grid">
        <vuetable-pagination-info ref="paginationInfo"
        :info-template="infopag"
        ></vuetable-pagination-info>

        <vuetable-pagination ref="pagination"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage"
        ></vuetable-pagination>
      </div>
    </div>
  </div>
</template>

<style>
  .cargando {
  }
</style>

<script>
import Vue from 'vue'
import accounting from 'accounting'
import moment from 'moment'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import FilterBar from '@/components/datatable/FilterBar'
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    FilterBar
  },
  data () {
    return {
      dataurl : '',
      cargando: true,
      moreParams: {},
      infopag : 'Showing: {from} - {to} of {total} records',
      fields: [],
      css: {
      pagination: {
        infoClass: 'pull-left',
        wrapperClass: 'vuetable-pagination pull-right',
        activeClass: 'btn-primary',
        disabledClass: 'disabled',
        pageClass: 'btn btn-border',
        linkClass: 'btn btn-border',
        icons: {
          first: '',
          prev: '',
          next: '',
          last: '',
          }
        }
      }
    }
  },
  methods: {
    allcap (value) {
      return value.toUpperCase()
    },
    formatNumber (value) {
      return accounting.formatNumber(value, 2)
    },
    formatDate (value, fmt = 'D MMM YYYY') {
      return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
    },
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page);
    },
    onFilterSet (filter) {
        this.moreParams = {
            'filter': filter.filterText
        }
        Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    onFilterReset () {
        this.moreParams = {}
        Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    iniciarCarga () {
      this.cargando = true
    },
    terminarCarga () {
      this.cargando = false
    },
    consultaExitosa(){
    },
    consultaFallida(){
    }
  }
}
</script>