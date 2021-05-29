# 1. Using ncipollo/release-action for release management

Date: 2021-05-29

## Status

Accepted

## Context

We need to be able to create a release once a tag is pushed against the master branch.

## Decision

Use the community-developed [release-action](https://github.com/ncipollo/release-action) since it is actively updated and
seems to have a number of useful features. Particularly, the ability to create a release from a build artifact. Additionally,
the Github -developed action for release management is no longer maintained.

## Consequences

The release management approach may be fragmented across the DT community if the perceived value of this plugin is different.
