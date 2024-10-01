import { useEffect, useState } from 'react';
import fetchListaCarrera from '../../services/listaCarreraService.js';
import reactLogo from '../../assets/react.svg';
import viteLogo from '/vite.svg';

const HealthCheck = () => {
    const [status, setStatus] = useState([]); // Cambiado a un array porque esperamos una lista
    const [error, setError] = useState(null);

    useEffect(() => {
        const getHealthStatus = async () => {
            try {
                const data = await fetchListaCarrera();
                setStatus(data); // Aquí se almacena la lista de carreras
            } catch (err) {
                setError(err.message);
            }
        };
        getHealthStatus();
    }, []);

    return (
        <>
            <div>
                <a href="https://vitejs.dev" target="_blank">
                    <img src={viteLogo} className="logo" alt="Vite logo" />
                </a>
                <a href="https://react.dev" target="_blank">
                    <img src={reactLogo} className="logo react" alt="React logo" />
                </a>
            </div>
            <div>
                <h2>Available Carreras</h2>
                {error && <p>Error: {error}</p>}
                {status.length > 0 ? (
                    <ul>
                        {status.map((carrera) => (
                            <li key={carrera.id}>
                                {carrera.nombre} (ID: {carrera.id})
                            </li>
                        ))}
                    </ul>
                ) : (
                    <h3>Loading...</h3>
                )}
            </div>
        </>
    );
};

export default HealthCheck;