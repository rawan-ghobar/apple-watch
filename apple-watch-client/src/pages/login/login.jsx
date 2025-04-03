import React, { useState} from 'react';
import { useNavigate } from 'react-router-dom';  
import api from '../../services/api';
import './login.css';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState(null);
  const [isLoading, setIsLoading] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = async (event) => {
    event.preventDefault();
    setIsLoading(true);
    try {
      const response = await api.post('guest/login', { email, password });
      localStorage.setItem('token', response.data.token);
      navigate('/activity-chart');
      setIsLoading(false);
    } catch (err) {
      setError(err.response.data.errorMessage || 'Login failed');
      setIsLoading(false);
    }
  };

  return (
    <div className='login-container'>
    <form onSubmit={handleSubmit}>
      <div className='login-field'>
        <label>Email:</label>
        <input type="email" value={email} onChange={e => setEmail(e.target.value)} required />
      </div>
      <div className='login-field'>
        <label>Password:</label>
        <input type="password" value={password} onChange={e => setPassword(e.target.value)} required />
      </div>
      {error && <p>{error}</p>}
      <button type="submit" disabled={isLoading}>{isLoading ? 'Logging in...' : 'Log In'}</button>
    </form>
    </div>
  );
};

export default Login;
