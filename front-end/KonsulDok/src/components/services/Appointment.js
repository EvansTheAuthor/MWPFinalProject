import axios from 'axios';

export default{
    async getAll(page = 1, limit = 10){
        const res = await axios.get(`/appointments?page=${page}&limit=${limit}`);
        return res.data;
    },
    async getById(id) {
        const res = await axios.get(`/appointments/${id}`);
        return res.data;
    },
    async create({ doctor_id, appointment_date, notes }) {
        const res = await axios.post('/appointments', {
            doctor_id,
            appointment_date,
            notes
        });
        return res.data;
    },
    async cancel(id){
        const res = await axios.patch(`/appointments/${id}/cancel`);
        return res.data;
    }
}