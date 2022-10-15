import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    users: []
}

export const userSlice = createSlice({
    name: "users",
    initialState,
    reducers: {
        setUserList: (state, action) => {
            state.users = action.payload.users;
        }
    }
})

export const { setUserList } = userSlice.actions;
export default userSlice.reducer;