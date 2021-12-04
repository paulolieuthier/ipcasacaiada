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
            groups {
                name
                image
                page {
                    slug
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
        sermons: sermonSeries {
            nodes {
                name
                slug
                count
                image
            }
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
            slug: action.page[0]?.uri,
          }))
        })),
        sermons: data.sermons.nodes.map(series => ({
          name: series.name,
          image: series.image,
          slug: series.slug,
          count: series.count ?? 0,
        })),
        groups: data.theme.groups.map(group => ({
          name: group.name,
          image: group.image,
          slug: group.page[0]?.slug
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
  }
}
