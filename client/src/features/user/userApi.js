import { apiSlice } from "../api/apiSlice";
import { setUserList } from "./userSlice";

export const userApi = apiSlice.injectEndpoints({
  endpoints: (builder) => ({
    listUser: builder.query({
      query: () => "/users/list",
      async onQueryStarted(arg, { dispatch, queryFulfilled }) {
        try {
          const { data } = await queryFulfilled;

          dispatch(setUserList({
            users: data.data
          }))
        } catch (error) { }
      },
    }),
    stats: builder.query({
      query: () => "/users/stats",
      async onQueryStarted(arg, { dispatch, queryFulfilled }) {
        try {
          const { data } = await queryFulfilled;
        } catch (error) { }
      },
    }),
    transfer: builder.mutation({
      query: (data) => ({
        url: "/transfer/send",
        method: "POST",
        body: data,
      }),
      async onQueryStarted(arg, { dispatch, queryFulfilled }) {
        try {
          const result = await queryFulfilled;
        } catch (error) { }
      },
    }),
  }),
});

export const { useListUserQuery, useStatsQuery, useTransferMutation } = userApi;
