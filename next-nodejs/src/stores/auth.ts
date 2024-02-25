import { create } from "zustand";

export const useAuth = create((set) => ({
  user: null,
  logUserIn: (user: any) => set({ user }),
  logUserOut: () => set({ user: null }),
}));
