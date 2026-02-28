<template>
  <SidebarProvider :default-open="true">
    <Sidebar variant="inset">
      <SidebarHeader class="px-4 py-3">
        <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Admin</p>
        <p class="text-sm font-semibold text-slate-900 dark:text-white">PersonaHub</p>
      </SidebarHeader>
      <SidebarContent>
        <SidebarGroup>
          <SidebarGroupLabel>Overview</SidebarGroupLabel>
          <SidebarGroupContent>
            <SidebarMenu>
              <SidebarMenuItem>
                <SidebarMenuButton as-child :is-active="isActive('/admin')" class="cursor-pointer">
                  <NuxtLink to="/admin" class="flex items-center gap-2">
                    <LayoutDashboard class="h-4 w-4" />
                    Dashboard
                  </NuxtLink>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton as-child :is-active="isActive('/admin/users')" class="cursor-pointer">
                  <NuxtLink to="/admin/users" class="flex items-center gap-2">
                    <Users class="h-4 w-4" />
                    Users
                  </NuxtLink>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton as-child :is-active="isActive('/admin/apps')" class="cursor-pointer">
                  <NuxtLink to="/admin/apps" class="flex items-center gap-2">
                    <Package class="h-4 w-4" />
                    Apps
                  </NuxtLink>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton as-child :is-active="isActive('/admin/access')" class="cursor-pointer">
                  <NuxtLink to="/admin/access" class="flex items-center gap-2">
                    <ShieldCheck class="h-4 w-4" />
                    Access Control
                  </NuxtLink>
                </SidebarMenuButton>
              </SidebarMenuItem>
            </SidebarMenu>
          </SidebarGroupContent>
        </SidebarGroup>
        <SidebarGroup>
          <SidebarGroupLabel>Navigation</SidebarGroupLabel>
          <SidebarGroupContent>
            <SidebarMenu>
              <SidebarMenuItem>
                <SidebarMenuButton as-child class="cursor-pointer">
                  <NuxtLink to="/dashboard" class="flex items-center gap-2">
                    <Home class="h-4 w-4" />
                    Back to Dashboard
                  </NuxtLink>
                </SidebarMenuButton>
              </SidebarMenuItem>
            </SidebarMenu>
          </SidebarGroupContent>
        </SidebarGroup>
      </SidebarContent>
      <SidebarFooter class="px-4 py-3 text-xs text-slate-500 dark:text-slate-400">
        Admin Console
      </SidebarFooter>
    </Sidebar>

    <SidebarInset class="min-h-0">
      <header class="flex items-center gap-2 border-b border-slate-200 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-950">
        <SidebarTrigger class="cursor-pointer" />
        <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Admin</span>
      </header>
      <section class="flex-1 min-h-0 overflow-y-auto p-6">
        <slot />
      </section>
    </SidebarInset>
  </SidebarProvider>
</template>

<script setup lang="ts">
import { 
  SidebarProvider, Sidebar, SidebarHeader, SidebarContent, SidebarFooter, SidebarGroup, SidebarGroupLabel, SidebarGroupContent, SidebarMenu, SidebarMenuItem, SidebarMenuButton, SidebarInset, SidebarTrigger 
} from '@/components/ui/sidebar'
import { LayoutDashboard, Users, Package, ShieldCheck, Home } from 'lucide-vue-next'

const route = useRoute()

const isActive = (path: string) => route.path === path
</script>
