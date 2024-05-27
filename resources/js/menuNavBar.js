import {
  mdiMenu,
  mdiClockOutline,
  mdiCloud,
  mdiCrop,
  mdiAccount,
  mdiCogOutline,
  mdiEmail,
  mdiLogout,
  mdiThemeLightDark,
  mdiGithub,
  mdiOfficeBuildingCog,mdiChairRolling,
  mdiReact,
} from "@mdi/js";

export default [

  {
    icon: mdiThemeLightDark,
    label: "Light/Dark",
    isDesktopNoLabel: true,
    isToggleLightDark: true,
  },

  {
    isCurrentUser: true,
    menu: [
      {
        icon: mdiAccount,
        label: "Profile",
        // route: "profile:url",
      },
      {
        icon: mdiLogout,
        label: "Log Out",
        isLogout: true,
      },
    ],
  }

];
