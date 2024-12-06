const API_BASE_URL = "http://localhost:8000/api";

const fetchCarreraStatus = async () => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras`);
      console.log(response);

      if (!response.ok) {
         // Si la respuesta no es OK, manejamos errores específicos
         if (response.status === 404) {
            // Error 404 con un mensaje claro
            throw new Error("No se encontraron carreras. Por favor, agrega una carrera.");
         } else {
            // Otros errores genéricos
            throw new Error(`${response.status} ${response.statusText}`);
         }
      }

      const data = await response.json();

      if (!data.success) {
         // Control de errores del backend, traducimos el mensaje de error
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data; // Retornamos solo el arreglo "data"
   } catch (error) {
      // Log del error para desarrollo y re-lanzamos para manejarlo en el componente
      console.error("Error al obtener las carreras:", error.message);
      throw error;
   }
};

const fetchCarreraById = async (id) => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras/${id}`);

      if (!response.ok) {
         throw new Error(`Error ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();

      if (!data.success) {
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data;
   } catch (error) {
      console.error(`Error al obtener la carrera con ID ${id}:`, error.message);
      throw error;
   }
};

const updateCarrera = async (id, updatedData) => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras/${id}`, {
         method: "PUT",
         headers: {
            "Content-Type": "application/json",
         },
         body: JSON.stringify(updatedData),
      });

      if (!response.ok) {
         throw new Error(`Error ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();

      if (!data.success) {
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data; // Suponemos que el backend devuelve los datos actualizados
   } catch (error) {
      console.error(`Error al actualizar la carrera con ID ${id}:`, error.message);
      throw error;
   }
};

const carrerasService = {
   fetchCarreraStatus,
   fetchCarreraById,
   updateCarrera, // <-- Nuevo método
};

export default carrerasService;
