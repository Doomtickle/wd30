<template>
    <div class="container mx-auto">
        <div class="lead-controls flex justify-between items-center py-2 flex-wrap">
            <lead-pagination
                    @page="page"
                    :pagination="pagination"
                    class="w-full md:w-auto"
            />
            <lead-filters
                    @toggle="filter"
                    :active-filter="activeFilter"
                    :important-filter="importantFilter"
                    class="w-full md:max-w-xs"
            />
        </div>
        <lead
            v-for="lead in leads"
            :key="lead.id"
            :lead="lead"
            :active-leads="activeFilter"
            :current-page="pagination.current_page"
            @archived="onArchived"
            @unarchived="onUnarchived"
            @important="refresh"
        />
        <lead-pagination
            @page="page"
            :pagination="pagination"
        />
    </div>

</template>

<script>
import Pagination from '../models/pagination';
import LeadService from '../services/leads.service';
export default {
    data() {
        return {
            pagination: new Pagination({
                next_page_url: '',
                prev_page_url: '',
                from: '',
                to: '',
                last_page: '',
                current_page: '',
                total: ''
            }),
            leads:  [],
            leadService: new LeadService(),
            activeFilter: true,
            importantFilter: false,
        }
    },
    mounted () {
        this.getActive();
    },
    watch: {
        activeFilter: function (active) {
            if (active) {
                this.getActive(this.importantFilter);
            } else {
                this.getArchived(this.importantFilter);
            }
        },
        importantFilter: function (important) {
           if (this.activeFilter) {
               this.getActive(important);
            } else {
                this.getArchived(important);
            }
        }
    },
    methods: {
        page (url) {
            this.leadService.getPage(url)
                .then(response => {
                    this.leads = response.data.data;
                    this.pagination = new Pagination(response.data);
                })
        },
        filter (attribute) {
            this[attribute] = ! this[attribute];
        },
        onArchived () {
            this.getActive(this.importantFilter, this.pagination.current_page);
            this.$emit('archived');
        },
        onUnarchived () {
            this.getArchived(this.importantFilter, this.pagination.current_page);
            this.$emit('unarchived');
        },
        getActive (important = this.importantFilter, page = 1) {
            this.leadService.activeLeads(important, page)
                .then(response => {
                    this.leads = response.data.data;
                    this.pagination = response.data;
                });
        },
        getArchived (important = this.importantFilter, page = 1) {
            this.leadService.archivedLeads(important, page)
                .then(response => {
                    this.leads = response.data.data;
                    this.pagination = response.data;
                });
        },
        refresh (active, page) {
            if (active) {
                this.getActive(this.importantFilter, page);
            }else {
                this.getArchived(this.importantFilter, page);
            }
        }
    }
}
</script>

<style>
</style>

