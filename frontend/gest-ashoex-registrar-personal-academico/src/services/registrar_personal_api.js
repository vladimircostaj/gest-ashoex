 // URL de API de prueba, remplazar por la URL de la API real
const API_URL = 'https://jsonplaceholder.typicode.com';

export const registrarPersonal = async (formData) => {
  try {
    const response = await fetch(`${API_URL}/posts`, {
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