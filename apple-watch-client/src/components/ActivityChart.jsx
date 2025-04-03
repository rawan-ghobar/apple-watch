import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { fetchData } from '../redux/dataslice';
import { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, Legend } from 'recharts';

const ActivityChart = () => {
    const { items, status, error } = useSelector(state => state.data);
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(fetchData());
    }, [dispatch]);

    if (status === 'loading') return <p>Loading...</p>;
    if (error) return <p>Error: {error}</p>;

    return (
        <LineChart width={600} height={300} data={items}
            margin={{ top: 5, right: 30, left: 20, bottom: 5 }}>
            <CartesianGrid strokeDasharray="3 3" />
            <XAxis dataKey="date" />
            <YAxis />
            <Tooltip />
            <Legend />
            <Line type="monotone" dataKey="steps" stroke="#8884d8" />
            <Line type="monotone" dataKey="distance_km" stroke="#82ca9d" />
            <Line type="monotone" dataKey="active_minutes" stroke="#82ca9d" />
        </LineChart>
    );
};

export default ActivityChart;