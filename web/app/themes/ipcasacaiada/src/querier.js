import { useQuery, useResult } from '@vue/apollo-composable'
import gql from 'graphql-tag'

export default {
  home: () => {
    const { result, loading } = useQuery(gql`
      query {
        site: generalSettings {
          title
          description
        }
        theme: crbThemeOptions {
          logo
          welcomeTitle
          welcomeSubtitle
          welcomeVideo
          banners {
            image
            page {
              uri
            }
          }
          aboutUs {
            title
            content
            image
            actions {
              text
              page {
                uri
              }
            }
          }
          sermonSeries {
            title
            image
            url
          }
          groups {
            name
            image
            page {
              uri
            }
          }
          contactWhatsapp,
          contactPhone,
          contactLocation,
          contactEmail,
          footerFirstTitle,
          footerFirst,
          footerSecondTitle,
          footerSecond,
          socialYoutube,
          socialInstagram,
          socialFacebook,
          socialSpotify,
        }
      }`)

    return {
      loading,
      data: useResult(result, null, data => ({
        title: data.site.title,
        subtitle: data.site.description,
        logo: data.theme.logo,
        welcome: {
          title: data.theme.welcomeTitle,
          subtitle: data.theme.welcomeSubtitle,
          video: data.theme.welcomeVideo,
        },
        banners: data.theme.banners.map(banner => ({
          image: banner.image,
          uri: banner.page[0]?.uri,
        })),
        aboutUs: data.theme.aboutUs.map(about => ({
          title: about.title,
          content: about.content,
          image: about.image,
          buttons: about.actions.map(action => ({
            text: action.text,
            uri: action.page[0]?.uri,
          }))
        })),
        sermons: data.theme.sermonSeries,
        groups: data.theme.groups.map(group => ({
          name: group.name,
          image: group.image,
          uri: group.page[0]?.uri
        })),
        contact: {
          whatsapp: data.theme.contactWhatsapp,
          phone: data.theme.contactPhone,
          location: data.theme.contactLocation,
          email: data.theme.contactEmail,
        },
        footer: {
          first: {
            title: data.theme.footerFirstTitle,
            content: data.theme.footerFirst,
          },
          second: {
            title: data.theme.footerSecondTitle,
            content: data.theme.footerSecond,
          },
          social: {
            youtube: data.theme.socialYoutube,
            instagram: data.theme.socialInstagram,
            facebook: data.theme.socialFacebook,
            spotify: data.theme.socialSpotify,
          }
        }
      }))
    }
  },

  page: (uri) => {
    const { result, loading } = useQuery(gql`
      query {
        theme: crbThemeOptions {
          bannerStandalonePage
        }
        page: pageBy(uri: "${uri}") {
          title
          content
        }
      }`)

    return {
      loading,
      data: useResult(result, null, data => ({
        banner: data.theme.bannerStandalonePage,
        title: data.page.title,
        content: data.page.content,
      }))
    }
  },
}
