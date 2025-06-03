import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.withCredentials = true;


export async function getDoctorsByCategory(category, page=1, limit=10) {
    try{
        const res = await axios.get(`/doctors/${category}?page=${page}&limit=${limit}`);
        return res.data;
    }catch(err){
        console.error(err)
        return{doctors: [], hasMore: false, total: 0, message: "Gagal mengambil data dokter. Silakan coba lagi nanti."};
    }
}