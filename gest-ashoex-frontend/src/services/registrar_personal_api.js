 // URL de API de prueba, remplazar por la URL de la API real
 const API_URL = 'http://127.0.0.1:8000/api/';

 export const obtenerUsuario = async (id) => {
   try {
     const response = await fetch(`${API_URL}personal/${id}/informacion`);
     
     if (!response.ok) {
       throw new Error('Error al obtener la información del usuario');
     }
 
     return await response.json();
   } catch (error) {
     console.error("Error al obtener la información del usuario:", error);
     throw error;
   }
 };
 
 export const registrarPersonal = async (formData) => {
   try {
     const response = await fetch(`${API_URL}registrar-personal-academico`, {
       method: 'POST',
       headers: {
         'Content-Type': 'application/json',
       },
       body: JSON.stringify(formData),
     });
 
     if (!response.ok) {
       throw new Error('Error en la solicitud');
     }
 
     const data = await response.json();
     return data;
   } catch (error) {
     console.error('Error registrando personal:', error);
     throw error;
   }
 };