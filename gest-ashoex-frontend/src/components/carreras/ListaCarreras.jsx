import { useEffect, useState } from 'react';
import fetchListaCarrera from '../../services/listaCarreraService.js';
import reactLogo from '../../assets/react.svg';
import viteLogo from '/vite.svg';

const ListaCarreras = () => {
    const [status, setStatus] = useState([]);
    const [error, setError] = useState(null);

    useEffect(() => {
        const getHealthStatus = async () => {
            try {
                const data = await fetchListaCarrera();
                setStatus(data); 
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
                {error && <p style={{ color: 'red' }}>Error: {error}</p>}
                {status.length > 0 ? (
                    <table style={tableStyle}>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            {status.map((carrera) => (
                                <tr key={carrera.id}>
                                    <td>{carrera.id}</td>
                                    <td>{carrera.nombre}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                ) : (
                    <h3>Loading...</h3>
                )}
            </div>
        </>
    );
};

const tableStyle = {
    width: '80%',
    margin: '20px auto',
    borderCollapse: 'collapse',
    fontFamily: 'Arial, sans-serif',
    textAlign: 'left',
    border: '1px solid #ddd',
    boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.1)',
};

const thStyle = {
    padding: '12px',
    backgroundColor: '#f4f4f4',
    borderBottom: '2px solid #ddd',
};

const tdStyle = {
    padding: '12px',
    borderBottom: '1px solid #ddd',
};

export default ListaCarreras;
