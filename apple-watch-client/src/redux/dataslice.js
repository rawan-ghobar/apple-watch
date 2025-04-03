import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import api from '../services/api';

export const fetchData = createAsyncThunk('data/fetchData', async (_, { rejectWithValue }) => {
  try {
    const response = await api.get('user/activities');
    return response.data;
  } catch (err) {
    return rejectWithValue(err.response ? err.response.data : { errorMessage: 'Something went wrong' });
  }
});

const initialState = {
  items: [],
  status: 'idle',
  error: null
};

const dataSlice = createSlice({
  name: 'data',
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(fetchData.pending, (state) => {
        state.status = 'loading';
      })
      .addCase(fetchData.fulfilled, (state, action) => {
        state.status = 'succeeded';
        state.items = action.payload;
      })
      .addCase(fetchData.rejected, (state, action) => {
        state.status = 'failed';
        state.error = action.payload.errorMessage || 'Could not fetch data';
      });
  }
});

export default dataSlice.reducer;