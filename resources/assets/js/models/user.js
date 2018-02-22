export default class User {
    constructor(data) {
        for (let field in data) {
            this[field] = data[field];
        }
    }
    authenticate () {
        var self = this;
        window.axios.get('/authenticate').then(response => {
            let data = response.data;
            for (let field in data) {
                self[field] = data[field];
            }
        });
    }
    update (updated) {
        window.axios({ method: 'patch', url: '/users/' + updated.id,
            data: {
                name: updated.name,
                email: updated.email,
                cell_phone: updated.cell_phone,
                office_phone: updated.office_phone,
                primary_phone: updated.primary_phone,
                company: updated.company,
                mls_id: updated.mls_id,
                address: updated.address
            }
        })
            .then(response => {
                let data = response.data;
                for (let field in data) {
                    self[field] = data[field];
                }
            });

    }
}